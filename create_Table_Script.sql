CREATE TABLE addresses (
  `a_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `line_1` varchar(50) DEFAULT NULL,
  `line_2` varchar(50) DEFAULT NULL,
  `line_3` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `other` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE members (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` datetime(6),
  `address_id` int(10) unsigned,
  `book_limit` int(10) unsigned,
  `status` bit(1),
  `admin` bit(1),
  PRIMARY KEY (`m_id`),
  FOREIGN KEY (`address_id`) REFERENCES addresses(a_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE books (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `quantity` int(10) unsigned,
  `subject` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE INDEX title_index ON books(`title`) USING BTREE;

CREATE TABLE transactions (
  `b_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `m_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`b_id`, `m_id`),
  FOREIGN KEY (`b_id`) REFERENCES books(`b_id`),
  FOREIGN KEY (`m_id`) REFERENCES members(`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;