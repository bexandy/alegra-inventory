CREATE TABLE locales (
  locale_id char(5) PRIMARY KEY NOT NULL,
  locale_plural_forms varchar(255)  NOT NULL
);

INSERT INTO locales (locale_id, locale_plural_forms) VALUES ('en_US', 'nplurals=2; plural=(n != 1);');
INSERT INTO locales (locale_id, locale_plural_forms) VALUES ('es_ES', 'nplurals=2; plural=(n != 1);');
'Lista de Precios de Prueba' => 'Test Price List',