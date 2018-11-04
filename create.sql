CREATE DATABASE IF NOT EXISTS LoveHostess;

USE LoveHostess;

CREATE TABLE IF NOT EXISTS hostess(
    `id`             INT AUTO_INCREMENT PRIMARY KEY        COMMENT '选手ID',
    `name`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手姓名',
    `grade`          VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手年级',
    `academy`        VARCHAR(50)       NOT NULL DEFAULT '' COMMENT '选手学院',
    `tele`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手电话',
    `time`           VARCHAR(255)      NOT NULL DEFAULT '' COMMENT '选手海选时间',    
    `created_at`     DATETIME          NOT NULL            COMMENT '创建时间',
    `updated_at`     DATETIME          NOT NULL            COMMENT '修改时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='选手表';


CREATE TABLE IF NOT EXISTS finalhostess(
    `id`             INT AUTO_INCREMENT PRIMARY KEY        COMMENT '选手ID',
    `name`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手姓名',
    `grade`          VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手年级',
    `academy`        VARCHAR(50)       NOT NULL DEFAULT '' COMMENT '选手学院',
    `tele`           VARCHAR(20)       NOT NULL DEFAULT '' COMMENT '选手电话',
    `declaration`    TEXT              NOT NULL            COMMENT '选手宣言',
    `imgsrc`         VARCHAR(255)      NOT NULL DEFAULT '' COMMENT '选手照片',
    `audiosrc`       VARCHAR(255)      NOT NULL DEFAULT '' COMMENT '选手声音',         
    `votes`          INT UNSIGNED      NOT NULL DEFAULT 0 COMMENT '选手投票数',
    `created_at`     DATETIME          NOT NULL            COMMENT '创建时间',
    `updated_at`     DATETIME          NOT NULL            COMMENT '修改时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='决赛选手表';


CREATE TABLE IF NOT EXISTS votes(
    `id`             INT AUTO_INCREMENT PRIMARY KEY        COMMENT 'ID',
    `openid`         VARCHAR(255)      NOT NULL DEFAULT '' COMMENT '微信id',   
    `nickname`       VARCHAR(50)       NOT NULL DEFAULT '' COMMENT '微信昵称',
    `headpic`        VARCHAR(255)      NOT NULL DEFAULT '' COMMENT '微信头像url',
    `time`           DATE              NOT NULL DEFAULT '1970-01-01' COMMENT '用户上一次投票时间',    
    `final_id`       INT               NOT NULL DEFAULT 0  COMMENT '投票选手id',
    `created_at`     DATETIME          NOT NULL            COMMENT '创建时间',
    `updated_at`     DATETIME          NOT NULL            COMMENT '修改时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='投票表';

