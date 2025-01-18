# Setup pentru Proiect

## 1. Pornirea serviciilor Docker

În directorul root al proiectului, rulează următoarea comandă pentru a porni containerele definite în `docker-compose.yml`:

```bash
docker-compose up -d
```

Aceasta comandă va:
- Porni serviciul PHP pentru aplicația ta.
- Porni baza de date MySQL.
- Porni phpMyAdmin (dacă este configurat).

> **Notă:** Asigură-te că ai instalat și configurat Docker și Docker Compose pe sistemul tău înainte de a rula comanda.

---

## 2. Pornirea BrowserSync

După ce serviciile Docker rulează, folosește **BrowserSync** pentru a monitoriza fișierele proiectului și pentru a reîncărca automat browserul la modificări.

Rulează următoarea comandă în directorul root al proiectului:

```bash
browser-sync start --proxy "localhost:9000" --files "./src/**/*"
```

Aceasta comandă va:
- Proxy către serverul PHP care rulează pe `localhost:9000`.
- Monitoriza toate fișierele din directorul `src` și subdirectoarele acestuia.
- Reîncărca automat pagina în browser la orice modificare detectată.

---

## 3. Accesarea aplicației

După ce ai pornit BrowserSync, accesează aplicația la următorul URL:
```
http://localhost:3000
```

Dacă dorești să accesezi aplicația de pe un alt dispozitiv din aceeași rețea, folosește URL-ul **External** afișat de BrowserSync (ex.: `http://192.168.x.x:3000`).
