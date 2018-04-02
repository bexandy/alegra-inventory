DROP TABLE messages;
CREATE TABLE messages (
  message_id INTEGER PRIMARY KEY AUTOINCREMENT,
  locale_id char(5)  NOT NULL ,
  message_domain varchar(255)  NOT NULL,
  message_key text NOT NULL,
  message_translation text NOT NULL,
  message_plural_index tinyint(3)  NOT NULL,
  FOREIGN KEY (locale_id) REFERENCES locales(locale_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);

INSERT INTO messages (locale_id, message_domain, message_key, message_translation, message_plural_index)
VALUES ('en_US', 'default', 'Lista de Precios de Prueba', 'Test Price List', 0 );