<?php
/**
 * BD Config
 */
Class bdConfig{
    public $login_bd   =  'root'; /*Логин*/
    public $pass_bd    =  'root'; /*Пароль*/
    public $host_bd    =  'localhost'; /*Сервер*/
    public $table_name =  'servicedesk'; /*Имя БД*/
}

Class CreateBD{
    private $link;

    function __construct()
    {
        $objLink = new ConnectBd();

        $this->link = $objLink->link;    

        $this->config();

        //$this->createBd();

        $this->createTAbleRoles();

        $this->createTableUsers();

        $this->creatwTableKlassTruble();

        $this->createTableTypeTruble();

        $this->createTableOrdders();

        $this->createTableOrderFnswers();

        $this->setConfBd();

    }
    function config(){
        $sql = "SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; ".
        "SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; ".
        "SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'; ";

        $this->link->query($sql);
    }

    private function createBd()
    {
        $sql = "CREATE SCHEMA IF NOT EXISTS `servicedesk` DEFAULT CHARACTER SET utf8 ;".
                "USE `servicedesk` ;";
        $this->link->query($sql);
    }

    private function createTableRoles(){
        $sql = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NULL,
            `del` INT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_role_UNIQUE` (`id` ASC))
          ENGINE = InnoDB;";

         var_dump($this->link->query($sql)); 
    }

    private function createTableUsers(){
        $sql1 = "CREATE TABLE IF NOT EXISTS `servicedesk`.`users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NULL,
            `email` VARCHAR(45) NULL,
            `phone` VARCHAR(45) NULL,
            `pass` VARCHAR(45) NULL,
            `del` INT NULL DEFAULT 0,
            `roles_id` INT NOT NULL,
            `pc_name` VARCHAR(45) NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_users_UNIQUE` (`id` ASC),
            INDEX `fk_users_roles1_idx` (`roles_id` ASC),
            CONSTRAINT `fk_users_roles1`
              FOREIGN KEY (`roles_id`)
              REFERENCES `servicedesk`.`roles` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;";

        var_dump($this->link->query($sql1));
    }

    private function creatwTableKlassTruble(){
        $sql2 = "CREATE TABLE IF NOT EXISTS `servicedesk`.`klass_truble` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NULL,
            `del` INT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_klass_truble_UNIQUE` (`id` ASC) )
          ENGINE = InnoDB;";

        var_dump($this->link->query($sql2));
    }

    private function createTableTypeTruble(){
        $sql = "CREATE TABLE IF NOT EXISTS `servicedesk`.`type_truble` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NULL,
            `del` INT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_type_truble_UNIQUE` (`id` ASC) )
          ENGINE = InnoDB;";
          var_dump($this->link->query($sql));
    }

    private function createTableOrdders(){
        $sql = "CREATE TABLE IF NOT EXISTS `servicedesk`.`orders` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `dt` DATETIME NULL,
            `dt_ext` DATETIME NULL,
            `text` TEXT NULL,
            `status` INT NULL DEFAULT 0,
            `file_name` VARCHAR(45) NULL,
            `ip_comp` VARCHAR(45) NULL,
            `name_comp` VARCHAR(45) NULL,
            `klass_truble_id` INT NOT NULL,
            `type_truble_id` INT NOT NULL,
            `users_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_order_UNIQUE` (`id` ASC) ,
            INDEX `fk_orders_klass_truble1_idx` (`klass_truble_id` ASC) ,
            INDEX `fk_orders_type_truble1_idx` (`type_truble_id` ASC) ,
            INDEX `fk_orders_users1_idx` (`users_id` ASC) ,
            CONSTRAINT `fk_orders_klass_truble1`
              FOREIGN KEY (`klass_truble_id`)
              REFERENCES `servicedesk`.`klass_truble` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_orders_type_truble1`
              FOREIGN KEY (`type_truble_id`)
              REFERENCES `servicedesk`.`type_truble` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_orders_users1`
              FOREIGN KEY (`users_id`)
              REFERENCES `servicedesk`.`users` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;";

          var_dump($this->link->query($sql));
    }

    private function createTableOrderFnswers(){
        $sql = "CREATE TABLE IF NOT EXISTS `servicedesk`.`order_answers` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `text` TEXT NULL,
            `dt` DATETIME NULL,
            `orders_id` INT UNSIGNED NOT NULL,
            `users_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `id_order_answer_UNIQUE` (`id` ASC) ,
            INDEX `fk_order_answers_orders_idx` (`orders_id` ASC) ,
            INDEX `fk_order_answers_users1_idx` (`users_id` ASC) ,
            CONSTRAINT `fk_order_answers_orders`
              FOREIGN KEY (`orders_id`)
              REFERENCES `servicedesk`.`orders` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION,
            CONSTRAINT `fk_order_answers_users1`
              FOREIGN KEY (`users_id`)
              REFERENCES `servicedesk`.`users` (`id`)
              ON DELETE NO ACTION
              ON UPDATE NO ACTION)
          ENGINE = InnoDB;";

        var_dump($this->link->query($sql));
    }

    private function setConfBd()
    {
        $sql = "SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;";

        var_dump($this->link->query($sql));
    }

}

Class ConnectBd{
    private $loginBd;
    private $passBd;
    private $hostBd;
    private $nameBd;
    public  $link;

    public function __construct()
    {
        $bdConfig = new bdConfig();
        $this->loginBd = $bdConfig->login_bd;
        $this->passBd  = $bdConfig->pass_bd;
        $this->hostBd  = $bdConfig->host_bd;
        $this->nameBd  = $bdConfig->table_name;
        
        /*Строка подключения*/
        $this->link = new mysqli($this->hostBd, $this->loginBd, $this->passBd, $this->nameBd);
        if($this->link->connect_errno){
            echo'ERROR CONNECT TO DB' . $this->link->connect_error;
        }
        $this->link->query("SET NAMES utf8");
    }
}

$obj = new CreateBD();

echo 'test';