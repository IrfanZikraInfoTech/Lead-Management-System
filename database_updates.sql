DELIMITER //
CREATE PROCEDURE CreateAndAlterTables()
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION 
    BEGIN
        SHOW ERRORS;
        ROLLBACK;
    END;

    START TRANSACTION;

    -- Creating tbl_leadsinbox
    CREATE TABLE `tbl_leadsinbox` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `lead_id` INT NOT NULL,
        `sent_by` ENUM('admin', 'lead') NOT NULL,
        `sent_by_id` INT NOT NULL,
        `subject` TEXT NOT NULL,
        `body` TEXT NOT NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    );

    -- Here we don't use IF NOT EXISTS because it's not supported for ADD COLUMN in MySQL
    ALTER TABLE tblleads ADD COLUMN email_message_id TEXT NULL;

    -- Creating tbl_territories
    CREATE TABLE `tbl_territories` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `title` TEXT NOT NULL,
        `population` INT NOT NULL,
        `value` INT NOT NULL,
        `data` TEXT NOT NULL,
        `created_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    );

    -- Creating tbl_counties
    CREATE TABLE `tbl_counties` (
        `county_name` varchar(30) DEFAULT NULL,
        `county_fips` varchar(10) DEFAULT NULL
    );

    -- Inserting into tbl_counties
    INSERT INTO `tbl_counties` (`county_name`, `county_fips`) VALUES ('', '');

    -- Creating tbl_lead_lifecycle
    CREATE TABLE `tbl_lead_lifecycle` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `flow` TEXT NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    );

    -- Creating tblevent
    CREATE TABLE `tblevent` (
        `id` int(11) UNSIGNED NOT NULL,
        `meet_schedule_link` varchar(255) NOT NULL,
        `event_name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `status` int(11) DEFAULT 0,
        `lead_id` int(11) NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- More ALTER statements here
    ALTER TABLE tblproposals ADD pdf_path text null;
    ALTER TABLE tblleads ADD lifecycle_stage int not null default 0;
    ALTER TABLE tblevent MODIFY status int not null default 0;
    ALTER TABLE tblcontracts ADD rel_type varchar(25) default '';
    ALTER TABLE tblcontracts ADD rel_id int null;
    ALTER TABLE tblinvoices ADD rel_type varchar(25) default '';
    ALTER TABLE tblinvoices ADD rel_id int null;
    ALTER TABLE tblinvoices ADD proposal_link int null;
    ALTER TABLE tblproposals ADD contract_id int null AFTER invoice_id;
    ALTER TABLE tblleads ADD territory_id int(11) NULL;
    ALTER TABLE tbl_leadsinbox ADD view_by_admin int(1) DEFAULT 0;

    COMMIT;
END;
//
DELIMITER ;
