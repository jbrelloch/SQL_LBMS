delimiter $$

CREATE PROCEDURE dataLoad()
BEGIN
	DECLARE a INT;
	DECLARE b INT;
	DECLARE c INT;
	DECLARE d INT;
	
	DECLARE i1 INT;DECLARE i2 INT;DECLARE i3 INT;DECLARE i4 INT;DECLARE i5 INT;DECLARE i6 INT;DECLARE i7 INT;DECLARE i8 INT;DECLARE i9 INT;
	DECLARE cat INT;
	DECLARE category VARCHAR(20);
	DECLARE imageurl VARCHAR(250);
	DECLARE details VARCHAR(1000);

	DECLARE stopper INT;
	DECLARE member_holder INT;
	DECLARE order_holder INT;

	/* load books */
	SET details = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

	SET a=1;
	WHILE (a<=100) DO
		SET i1 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i2 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i3 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i4 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i5 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i6 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i7 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i8 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET i9 = FLOOR(0 + RAND() * (10));/* 0-9 */
		SET cat = FLOOR(1 + RAND() * (6));/* 1-6 */
		IF cat = 1 THEN SET category = 'Textbook';
			SET imageurl = "http://www.webweaver.nu/clipart/img/education/stack-of-books.png";
		ELSEIF cat = 2 THEN SET category = 'Historical';
			SET imageurl = "http://www-tc.pbs.org/wgbh/aia/part2/images/2cris2378b.jpg";
		ELSEIF cat = 3 THEN SET category = 'Biography';
			SET imageurl = "http://www.biography.com/imported/images/Biography/Images/Profiles/E/Albert-Einstein-9285408-1-402.jpg";
		ELSEIF cat = 4 THEN SET category = 'Fantasy';
			SET imageurl = "http://s3.amazonaws.com/rapgenius/1362582359_unicorn.jpg";
		ELSEIF cat = 5 THEN SET category = 'ScienceFiction';
			SET imageurl = "http://static4.wikia.nocookie.net/__cb20130310133315/starwars/images/5/58/Soldier_stub.png";
		ELSEIF cat = 6 THEN SET category = 'Romance';
			SET imageurl = "http://nyoobserver.files.wordpress.com/2013/01/50-shades-of-grey-cover-thumbnail.jpeg";
		ELSEIF cat = 7 THEN SET category = 'ERROR';
		END IF;
		INSERT INTO books (`b_id`,`title`,`author`,`isbn`,`quantity`,`subject`,`details`,`imageurl`) VALUES(NULL,CONCAT('title_',a),CONCAT('author_',a),CONCAT(i1,i2,i3,i4,i5,i6,i7,i8,i9),10000,category,details,imageurl);
		SET a=a+1;
	END WHILE;

	/* load members and addresses */
	SET b=1;
	WHILE (b<=200) DO
		INSERT INTO members (`m_id`,`email`,`password`,`first_name`,`last_name`,`date_of_birth`,`book_limit`,`status`,`admin`) VALUES(NULL,CONCAT('user_',b,'@users.com'),CONCAT('user_',b),CONCAT('first_',b),CONCAT('last_',b),'1111-11-11 11:11:11',100,1,0);
		SET member_holder=LAST_INSERT_ID();
		INSERT INTO addresses (`m_id`,`line_1`,`line_2`,`line_3`,`city`,`zip`,`state`,`country`,`other`) VALUES(member_holder,CONCAT('line1_',b),CONCAT('line2_',b),CONCAT('line3_',b),CONCAT('city_',b),CONCAT('zip_',b),CONCAT('state_',b),CONCAT('country_',b),CONCAT('other_',b));
		SET c=1;
		/* load transactions */
		WHILE (c<=100) DO
			INSERT INTO orders (`o_id`,`m_id`) VALUES(NULL,member_holder);
			SET order_holder=LAST_INSERT_ID();
			SET stopper = FLOOR(1 + RAND() * (7));/* each order will have 1-7 transactions */
			SET d=1;
			WHILE (d<=stopper) DO
				INSERT INTO transactions (`o_id`,`b_id`,`quantity`) SELECT order_holder,books.b_id,1 FROM books WHERE b_id=FLOOR(1 + RAND() * (100)) ON DUPLICATE KEY UPDATE transactions.quantity=transactions.quantity+1;
				SET d=d+1;
			END WHILE;
			SET c=c+1;
		END WHILE;
		SET b=b+1;
	END WHILE;
END$$

delimiter ;

call dataLoad();