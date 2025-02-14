<?php

class Customer
{
    use Controller; 

    public function index() 
    {
        $this->authorize(['customer']); 

        $albumModel = new AlbumModel();
        $albums = $albumModel->getAllActiveWithBandInfo();

        $this->view('albums', ['albums' => $albums], 'customer');
    }

    public function addToCart($id = null)
    {
        $this->authorize(['customer']);

        if (!$id) {
            $_SESSION['error'] = 'Album invalid.';
            header('Location: ' . ROOT . '/customer');
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        $_SESSION['success'] = 'Album adăugat în coș!';
        header('Location: ' . ROOT . '/customer/cart');
        exit;
    }

    public function cart()
    {
        $this->authorize(['customer']);

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $cartItems = [];
        } else {
            $cartItems = $_SESSION['cart']; 
        }

        $albumModel = new AlbumModel();
        $allAlbums = $albumModel->getAllActiveWithBandInfo();

        $cartDetails = [];
        $total = 0;

        foreach ($cartItems as $album_id => $quantity) {
            $album = null;
            if ($allAlbums) {
                foreach ($allAlbums as $a) {
                    if ($a->id == $album_id) {
                        $album = $a;
                        break;
                    }
                }
            }
            if ($album) {
                $itemTotal = $album->price * $quantity;
                $total += $itemTotal;
                $cartDetails[] = [
                    'album_id'   => $album->id,
                    'title'      => $album->title,
                    'band_name'  => $album->band_name,
                    'price'      => $album->price,
                    'quantity'   => $quantity,
                    'item_total' => $itemTotal
                ];
            }
        }

        $this->view('cart', [
            'cartDetails' => $cartDetails,
            'total'       => $total
        ], 'customer');
    }

    public function incrementQuantity($id = null)
    {
        $this->authorize(['customer']);

        if (!$id) {
            $_SESSION['error'] = 'Album invalid.';
            header('Location: ' . ROOT . '/customer/cart');
            exit;
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }

        header('Location: ' . ROOT . '/customer/cart');
        exit;
    }

    public function decrementQuantity($id = null)
    {
        $this->authorize(['customer']);

        if (!$id) {
            $_SESSION['error'] = 'Album invalid.';
            header('Location: ' . ROOT . '/customer/cart');
            exit;
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]--;
            if ($_SESSION['cart'][$id] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }

        header('Location: ' . ROOT . '/customer/cart');
        exit;
    }

    public function checkout()
    {
        $this->authorize(['customer']);

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['error'] = 'Coșul este gol. Nu se poate finaliza comanda.';
            header('Location: ' . ROOT . '/customer/cart');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Eroare: nu am putut identifica utilizatorul.';
            header('Location: ' . ROOT . '/customer/cart');
            exit;
        }

        $userId = $_SESSION['user_id'];

        $albumModel = new AlbumModel();
        $allAlbums = $albumModel->getAllActiveWithBandInfo();

        $totalOrder = 0;
        $cartItems = $_SESSION['cart'];

        $orderItemsData = [];

        foreach ($cartItems as $album_id => $quantity) {
            if ($allAlbums) {
                foreach ($allAlbums as $a) {
                    if ($a->id == $album_id) {
                        $price = $a->price;
                        $itemTotal = $price * $quantity;
                        $totalOrder += $itemTotal;

                        $orderItemsData[] = [
                            'album_id' => $album_id,
                            'quantity' => $quantity,
                            'price'    => $price,
                        ];
                        break;
                    }
                }
            }
        }

        $orderModel = new OrderModel();
        $orderId = $orderModel->createOrder($userId, 'pending', $totalOrder);

        $orderItemModel = new OrderItemModel();
        foreach ($orderItemsData as $item) {
            $item['order_id'] = $orderId;
            $orderItemModel->insert($item);
            $albumModel->decrementStock($item['album_id'], $item['quantity']);
        }

        unset($_SESSION['cart']);

        $_SESSION['success'] = "Comanda a fost plasată cu succes! (Order #$orderId)";
        header('Location: ' . ROOT . '/customer/orders'); 
        exit;
    }

    public function orders()
    {
        $this->authorize(['customer']);

        $orderModel = new OrderModel();
        $userId = $_SESSION['user_id'];

        $rows = $orderModel->getUserOrders($userId);

        $this->view('orders', ['orders' => $rows], 'customer');
    }

    public function contactForm()
    {
        $this->authorize(['customer']);
        $this->view('contact_form', [], 'customer');
    }

    public function sendContact()
    {
        $this->authorize(['customer']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $subject = trim($data['subject'] ?? '');
            $message = trim($data['message'] ?? '');

            if (empty($subject) || empty($message)) {
                $_SESSION['error'] = 'Subiectul și mesajul sunt obligatorii.';
                header('Location: ' . ROOT . '/customer/contactForm');
                exit;
            }

            $fromEmail = $_SESSION['email'] ?? 'unknown@example.com';

            $emailService = new EmailService();

            try {
                $emailService->sendContactMessage($fromEmail, $subject, $message);
                $_SESSION['success'] = 'Mesajul a fost trimis cu succes către Casa de Discuri.';
            } catch (Exception $e) {
                $_SESSION['error'] = 'Eroare la trimiterea email-ului: ' . $e->getMessage();
            }

            header('Location: ' . ROOT . '/customer/contactForm');
            exit;
        }

        header('Location: ' . ROOT . '/customer/contactForm');
        exit;
    }

    public function bandWiki($bandName = null)
    {
        $this->authorize(['customer']);

        if (!$bandName) {
            $_SESSION['error'] = 'Nume de trupă invalid.';
            header('Location: ' . ROOT . '/customer');
            exit;
        }

        $decodedName = urldecode($bandName);
        $bandModel = new BandModel();

        $existingBand = $bandModel->select_first(['name' => $decodedName]);

        if ($existingBand && !empty($existingBand->description)) {
            $wikiInfo = [
                "trupa" => $decodedName,
                "rezumat_original" => htmlspecialchars($existingBand->description),
                "rezumat_procesat" => htmlspecialchars($existingBand->description),
                "sursa" => "Baza de date",
                "imagine" => null,
                "data_extragerii" => date("Y-m-d H:i:s")
            ];
        } else {
            $wikiInfo = $this->fetchWikiExcerpt($decodedName);
        }

        $this->view('band_info', [
            'bandName' => $decodedName,
            'wikiInfo' => $wikiInfo
        ], 'customer');
    }

    private function fetchWikiExcerpt($numeTrupa)
    {
        $titluFormat = str_replace(' ', '_', $numeTrupa);
        $url = "https://ro.wikipedia.org/api/rest_v1/page/summary/" . $titluFormat;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $raspuns = curl_exec($ch);
        curl_close($ch);

        if (!$raspuns) {
            return [
                "status" => "eroare",
                "mesaj" => "Nu s-a putut obține informația de pe Wikipedia."
            ];
        }

        $date = json_decode($raspuns, true);

        if (isset($date['type']) && $date['type'] === "disambiguation") {
            $titluFormatNou = $titluFormat . ("_(formație)");
            return $this->fetchWikiExcerpt($titluFormatNou);
        }

        if (isset($date['extract']) && !empty($date['extract'])) {
            $rezumat_original = $date['extract'];
            $rezumat_procesat = preg_replace(['/,\s*care/', '/,\s*dar/', '/,\s*cu/'], 
                                             ['. Aceasta', '. De asemenea,', '. Include elemente de'], 
                                             $rezumat_original);
            $rezumat_procesat = preg_replace('/([.?!])\s+/', "$1\n", $rezumat_procesat);

            return [
                "trupa" => $numeTrupa,
                "rezumat_original" => htmlspecialchars($rezumat_original), 
                "rezumat_procesat" => htmlspecialchars($rezumat_procesat), 
                "sursa" => $date['content_urls']['desktop']['page'] ?? "N/A",
                "imagine" => $date['originalimage']['source'] ?? null,
                "data_extragerii" => date("Y-m-d H:i:s")
            ];
        }

        return [
            "status" => "eroare",
            "mesaj" => "Nu s-a găsit informație relevantă despre '$numeTrupa' pe Wikipedia."
        ];
    }
}
