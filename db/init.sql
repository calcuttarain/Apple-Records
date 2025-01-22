CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,  
  email VARCHAR(255) NOT NULL UNIQUE, 
  type ENUM('admin', 'staff', 'band_member', 'customer') NOT NULL DEFAULT 'customer',
  token VARCHAR(255), 
  verified BOOLEAN NOT NULL DEFAULT 0, 
  date_created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bands (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  description TEXT,
  date_formed DATE
);

CREATE TABLE IF NOT EXISTS band_members (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  band_id INT UNSIGNED NOT NULL,
  date_joined DATE,
  CONSTRAINT fk_band_members_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_band_members_band FOREIGN KEY (band_id) REFERENCES bands(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS albums (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  band_id INT UNSIGNED NOT NULL,
  title VARCHAR(200) NOT NULL,
  release_date DATE,
  format ENUM('vinyl', 'cassette', 'cd') NOT NULL,
  price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  stock_quantity INT NOT NULL DEFAULT 0,
  status ENUM('active', 'inactive') NOT NULL DEFAULT 'inactive',
  CONSTRAINT fk_albums_band FOREIGN KEY (band_id) REFERENCES bands(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status ENUM('pending', 'paid', 'shipped', 'delivered', 'canceled') NOT NULL DEFAULT 'pending',
  total_amount DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  order_id INT UNSIGNED NOT NULL,
  album_id INT UNSIGNED NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_order_items_album FOREIGN KEY (album_id) REFERENCES albums(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS requests (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  request_type ENUM('CONTRACT', 'ALBUM') NOT NULL,
  status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_requests_user FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS album_requests (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  request_id INT UNSIGNED NOT NULL,
  band_id INT UNSIGNED NOT NULL,
  title VARCHAR(200) NOT NULL,
  format ENUM('vinyl', 'cassette', 'cd') NOT NULL,
  notes TEXT,
  CONSTRAINT fk_album_requests_request FOREIGN KEY (request_id) REFERENCES requests(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_album_requests_band FOREIGN KEY (band_id) REFERENCES bands(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS contract_requests (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  request_id INT UNSIGNED NOT NULL,
  band_name VARCHAR(200) NOT NULL,
  members_emails TEXT,
  demo_link VARCHAR(255),
  CONSTRAINT fk_contract_requests_request FOREIGN KEY (request_id) REFERENCES requests(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- parola pentru toate conturile e Pass1234
INSERT INTO users (first_name, last_name, password, email, type, verified)
VALUES
  ('John', 'Admin', '$argon2id$v=19$m=65536,t=4,p=1$SDZFYkJicTZWMThUeUJsMA$7XlOYKj3w5CrSnQ/awRutKKsoDne5XX3SqM28rv9s4Y', 'john.admin@example.com', 'admin', 1),
  ('Jane', 'Staff', '$argon2id$v=19$m=65536,t=4,p=1$SDZFYkJicTZWMThUeUJsMA$7XlOYKj3w5CrSnQ/awRutKKsoDne5XX3SqM28rv9s4Y', 'jane.staff@example.com', 'staff', 1),
  ('Paul', 'McCartney', '$argon2id$v=19$m=65536,t=4,p=1$SDZFYkJicTZWMThUeUJsMA$7XlOYKj3w5CrSnQ/awRutKKsoDne5XX3SqM28rv9s4Y', 'paul.mccartney@example.com', 'band_member', 1),
  ('George', 'Costumer', '$argon2id$v=19$m=65536,t=4,p=1$SDZFYkJicTZWMThUeUJsMA$7XlOYKj3w5CrSnQ/awRutKKsoDne5XX3SqM28rv9s4Y', 'george.consumer@example.com', 'customer', 1);

INSERT INTO bands (name, description, date_formed)
VALUES
  ('The Beatles', 'A rock band formed in Liverpool', '1960-01-01'),
  ('Led Zeppelin', 'An English rock band formed in London', '1968-01-01'),
  ('Pink Floyd', 'An English rock band formed in London', '1965-01-01'),
  ('Phoenix', 'O trupa rock romanească din Timisoara', '1962-01-01');

INSERT INTO band_members (user_id, band_id, date_joined)
VALUES
  (3, 1, '1960-07-01');

INSERT INTO albums (band_id, title, release_date, format, price, stock_quantity, status)
VALUES
  (1, 'Please Please Me', '1963-03-22', 'vinyl', 19.99, 100, 'active'),
  (1, 'Abbey Road', '1969-09-26', 'cd', 24.99, 150, 'active');

INSERT INTO albums (band_id, title, release_date, format, price, stock_quantity, status)
VALUES
  (2, 'Led Zeppelin I', '1969-01-12', 'vinyl', 19.99, 100, 'active'),
  (2, 'Led Zeppelin IV', '1971-11-08', 'cassette', 14.99, 120, 'active');

INSERT INTO albums (band_id, title, release_date, format, price, stock_quantity, status)
VALUES
  (3, 'The Dark Side of the Moon', '1973-03-01', 'vinyl', 29.99, 200, 'active'),
  (3, 'The Wall', '1979-11-30', 'cd', 24.99, 180, 'active');

INSERT INTO albums (band_id, title, release_date, format, price, stock_quantity, status)
VALUES
  (4, 'Cei ce ne-au dat nume', '1972-01-01', 'vinyl', 19.99, 50, 'active'),
  (4, 'Mugur de fluier', '1974-01-01', 'cassette', 17.99, 60, 'active');
