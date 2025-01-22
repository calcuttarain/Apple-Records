<?php

class Customer
{
    use Controller; 

    public function index() 
    {
        $this->authorize(['customer']); 

        $albumModel = new AlbumModel();
        $albums = $albumModel->getAllActiveWithBandInfo();

        $this->view('customer_albums', ['albums' => $albums]);
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

        $this->view('customer_cart', [
            'cartDetails' => $cartDetails,
            'total'       => $total
        ]);
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

        $this->view('customer_orders', ['orders' => $rows]);
    }

}
