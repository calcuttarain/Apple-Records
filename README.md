# Apple Records – Sistem Digital de Management pentru Casa de Discuri

**Apple Records** este o aplicație web, realizată în PHP și MySQL, concepută pentru a gestiona operațiunile unei case de discuri. Sistemul facilitează interacțiunea dintre clienți, membri de trupă, staff și administratori.

> **Notă despre Docker**: Aplicația rulează într-un container Docker care include mediul PHP și Apache. Fișierele sursă, împreună cu `composer.json`, sunt copiate în container, iar extensiile PHP necesare sunt instalate (ex: `ext-pdo`, `ext-pdo_mysql`, `ext-gd`). Dockerfile-ul asigură instalarea dependențelor prin Composer și configurarea automată a serverului web.

---

## Funcționalități Cheie

### Managementul Utilizatorilor
- Sistem de autentificare sigur, cu verificare pe email folosind token-uri ([`Authentication`](src/app/controllers/Authentication.php))
- Roluri multiple: **Customer**, **Band Member**, **Staff** și **Admin**
- Control al accesului bazat pe sesiune și **dashboard-uri** specifice fiecărui rol

### Funcționalități pentru Clienți (Customer)
- Răsfoirea și achiziția de albume din catalog
- Funcționalitate de **coș de cumpărături** pentru administrarea achizițiilor
- Istoric de comenzi
- **Formular de contact** pentru a trimite mesaje către casa de discuri ([`customer_contact_form.view.php`](src/app/views/customer_contact_form.view.php))
- Acces la informații despre trupe, integrate din Wikipedia ([`Customer::fetchWikiExcerpt()`](src/app/controllers/Customer.php))

### Funcționalități pentru Membrii de Trupă (Band Member)
- Trimiterea de cereri de contract pentru a semna cu casa de discuri
- Cereri pentru lansarea de albume noi
- Urmărirea statusului cererilor
- Administrarea profilului trupei și a informațiilor aferente

### Funcționalități pentru Staff
- Revizuirea și procesarea cererilor de contract primite de la trupe
- Gestionarea cererilor de lansare a albumelor
- Stabilirea prețurilor și a stocurilor pentru albume noi
- Monitorizarea operațiunilor din catalog

### Funcționalități pentru Admin
- Acces la statistici extinse ale sistemului
- Descărcarea de rapoarte detaliate privind activitățile, în format **Excel** sau **CSV**
- Capabilități de monitorizare și administrare la nivel de sistem

### Analiză și Raportare
- Urmărirea vizitatorilor și a afișărilor de pagină(elemente statice) ([`StatsModel`](src/app/models/StatsModel.php))
- Logarea activității utilizatorilor
- Rapoarte descărcabile în diferite formate
- Dashboard de statistici în timp real

### Sistem de Comunicare
- Notificări automate prin email pentru verificarea conturilor
- Formular de contact cu integrare email ([`EmailService`](src/app/core/EmailService.php))
- Notificări interne privind actualizarea statusului cererilor

---

## Implementare Tehnică

### Arhitectură
- Aplicația urmează **modelul MVC**
- Sistem de **controller** bazat pe *trait*-uri pentru comportament unificat
- Sistem de **view** modular, cu componente reutilizabile

### Securitate
- Parole stocate cu **hashing** și proceduri de securitate
- Mecanism de verificare a email-ului prin **token**
- **Control de acces** bazat pe roluri (RBAC)
- **Sanitizare** și validare a input-urilor

### Baza de Date
- **MySQL** cu structură robustă și relații eficiente
- **Constrângeri** și integrități referențiale
- Suport pentru tranzacții în operațiunile critice

---

## Instrucțiuni de Configurare

Pentru detalii despre configurare, vezi fișierul [setup.md](setup.md). Acesta acoperă:

1. **Configurarea containerului Docker** și pornirea aplicației  
2. **Mediul de dezvoltare** și integrarea cu BrowserSync  
3. Accesul la aplicație și ajustarea setărilor  

