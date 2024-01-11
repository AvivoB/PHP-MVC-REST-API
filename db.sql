-- CREATE DATABASE IF NOT EXISTS `mvc-api-aviel`;


CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `role` VARCHAR(255) NOT NULL DEFAULT 'admin',
  `phone` VARCHAR(255) NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO users (`username`, `email`, `password`, `role`, `phone`) 
VALUES ('avivoB', 'avielber26@gmail.com', 'dgdddd', 'admin', '0614288354'), ('bavivo', 'aviel99.berebi@gmail.com', 'dgdddd', 'comptable', '0614288354');

CREATE TABLE IF NOT EXISTS `entreprises` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `siret` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255),
  `type_structure` VARCHAR(255) NOT NULL,
  `code_ape` VARCHAR(255),
  `phone` VARCHAR(255),
  `email` VARCHAR(255),
  `tva_number` VARCHAR(255),
  `options` JSON,
  PRIMARY KEY (`id`)
);

INSERT INTO entreprises (`name`, `siret`, `address`, `type_structure`, `code_ape`, `phone`, `email`, `tva_number`, `options`) 
VALUES ('Devivo', '969 999 999 9999', '6 rue raymond radiguet', 'EI', '', '06 01 00 00 00', 'contact@devivo.com', '', '{"rib": {"0": "FR76 0", "1":"FR76 1"}, "mail_from": "facture@devivo.com"}');

-- Relation entre entreprise et users
CREATE TABLE IF NOT EXISTS `user_entreprise` (
  `user_id` INT UNSIGNED NOT NULL,
  `entreprise_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `entreprise_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- INSERT INTO user_entreprise (user_id, entreprise_id) VALUES (1, 2);
-- SELECT u.*
-- FROM users u
-- JOIN user_entreprise ue ON u.id = ue.user_id
-- JOIN entreprises e ON ue.entreprise_id = e.id
-- WHERE e.name = 'Devivo';


CREATE TABLE IF NOT EXISTS `customers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `siret` VARCHAR(255),
  `address` VARCHAR(255),
  `phone` VARCHAR(255),
  `email` VARCHAR(255),
  `contact_name` VARCHAR(255),
  `code_ape` VARCHAR(255),
  `entreprise_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_customer_entreprise_idx` (`entreprise_id` ASC),
  CONSTRAINT `fk_customer_entreprise`
    FOREIGN KEY (`entreprise_id`)
    REFERENCES `entreprises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `estimates` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NOT NULL,
  `entreprise_id` INT UNSIGNED NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `lines_items` JSON,
  `total_ht` VARCHAR(255) NOT NULL,
  `total_ttc` VARCHAR(255) NOT NULL,
  `signature` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `acompte` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_estimate_entreprise_idx` (`entreprise_id` ASC),
  INDEX `fk_estimate_customer_idx` (`customer_id` ASC),
  CONSTRAINT `fk_estimate_entreprise`
    FOREIGN KEY (`entreprise_id`)
    REFERENCES `entreprises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_estimate_customer`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customers` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NOT NULL,
  `entreprise_id` INT UNSIGNED NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `lines_items` JSON,
  `total_ht` VARCHAR(255) NOT NULL,
  `total_ttc` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `acompte` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_invoice_entreprise_idx` (`entreprise_id` ASC),
  INDEX `fk_invoice_customer_idx` (`customer_id` ASC),
  CONSTRAINT `fk_invoice_entreprise`
    FOREIGN KEY (`entreprise_id`)
    REFERENCES `entreprises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_invoice_customer`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customers` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` INT UNSIGNED NOT NULL,
  `entreprise_id` INT UNSIGNED NOT NULL,
  `invoice_id` INT UNSIGNED NOT NULL,
  `to_rib` VARCHAR(255) NOT NULL,
  `payment_method` VARCHAR(255) NOT NULL,
  `stripe_id` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_transaction_entreprise_idx` (`entreprise_id` ASC),
  INDEX `fk_transaction_customer_idx` (`customer_id` ASC),
  INDEX `fk_transaction_invoice_idx` (`invoice_id` ASC),
  CONSTRAINT `fk_transaction_entreprise`
    FOREIGN KEY (`entreprise_id`)
    REFERENCES `entreprises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_customer`
    FOREIGN KEY (`customer_id`)
    REFERENCES `customers` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_transaction_invoice`
    FOREIGN KEY (`invoice_id`)
    REFERENCES `invoices` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS `objects_storage` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `entreprise_id` INT UNSIGNED NOT NULL,
  `document_id` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_objects_storage_entreprise_idx` (`entreprise_id` ASC),
  CONSTRAINT `fk_objects_storage_entreprise`
    FOREIGN KEY (`entreprise_id`)
    REFERENCES `entreprises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);