delimiter $$

CREATE PROCEDURE dataLoad()
BEGIN
	DECLARE a INT;
	DECLARE b INT;
	DECLARE c INT;
	DECLARE d INT;
	DECLARE member_holder INT;

	/* load books */
	SET a=1;
	WHILE (a<=100) DO
	  INSERT INTO books (`b_id`,`title`,`author`,`isbn`,`quantity`,`subject`) VALUES(NULL,CONCAT('title_',a),CONCAT('author_',a),CONCAT('isbn_',a),10000,CONCAT('subject_',a));
	  SET a=a+1;
	END WHILE;

	/* load members and addresses */
	SET b=1;
	WHILE (b<=200) DO
	  INSERT INTO addresses (`a_id`,`line_1`,`line_2`,`line_3`,`city`,`zip`,`state`,`country`,`other`) VALUES(NULL,CONCAT('line1_',b),CONCAT('line2_',b),CONCAT('line3_',b),CONCAT('city_',b),CONCAT('zip_',b),CONCAT('state_',b),CONCAT('country_',b),CONCAT('other_',b));
	  INSERT INTO members (`m_id`,`email`,`password`,`first_name`,`last_name`,`date_of_birth`,`address_id`,`book_limit`,`status`,`admin`) VALUES(NULL,CONCAT('user_',b,'@users.com'),CONCAT('user_',b),CONCAT('first_',b),CONCAT('last_',b),'1111-11-11 11:11:11',LAST_INSERT_ID(),100,1,0);

		SET c=1;
		SET d=1;
		SET member_holder=LAST_INSERT_ID();
		/* load transactions */
		WHILE (c<=100) DO
		  INSERT INTO transactions (`b_id`,`quantity`,`m_id`) SELECT books.b_id,d,member_holder FROM books WHERE b_id=FLOOR(1 + RAND() * (99)) ON DUPLICATE KEY UPDATE transactions.quantity=transactions.quantity+d;
		  SET c=c+1;
		  IF (d>5) THEN
			SET d=1;
		  ELSE
			SET d=d+1;
		  END IF;
			
		END WHILE;

	  SET b=b+1;
	END WHILE;

END$$

delimiter ;

call dataLoad();