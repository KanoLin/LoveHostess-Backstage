CREATE DATABASE IF NOT EXISTS LoveHostess;

USE LoveHostess;

CREATE TABLE IF NOT EXISTS hostess(
    `id`             INT AUTO_INCREMENT PRIMARY KEY        COMMENT '选手ID',
    `name`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手姓名',
    `grade`          VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手年级',
    `academy`        VARCHAR(50)       NOT NULL DEFAULT '' COMMENT '选手学院',
    `tele`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手电话',
    `time`           DATETIME          NOT NULL            COMMENT '选手海选时间',    
    `created_at`     DATETIME          NOT NULL            COMMENT '创建时间',
    `updated_at`     DATETIME          NOT NULL            COMMENT '修改时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='选手表';
