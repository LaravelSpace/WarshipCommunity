## user

#### 表结构

| 字段名            | 字段类型     | 是否为空和默认值 | 字段描述                                        |
| ----------------- | ------------ | ---------------- | ----------------------------------------------- |
| id                | int unsigned | not null         | 自增主键，起始 1000                             |
| name              | varchar(16)  | not null         | 昵称                                            |
| email             | varchar(64)  | not null         | 邮箱地址                                        |
| email_verified_at | datetime     | null             | 邮箱地址验证时间                                |
| phone             | varchar(16)  | not null         | 手机号码                                        |
| phone_verified_at | datetime     | null             | 手机号码验证时间                                |
| password          | varchar(64)  | not null         | 密码，默认使用 Laravel 框架的 Hash::make() 处理 |
| avatar            | varchar(128) | not null         | 头像图片 uri                                    |
| api_token         | varchar(64)  | not null         | 用于授权                                        |
| remember_token    | varchar(64)  | not null         | 用于记住我                                      |
| created_at        | datetime     | not null         | default current_timestamp                       |
| updated_at        | datetime     | null             | on update current_timestamp                     |

| 索引名            | 索引类型 | 字段名 |
| ----------------- | -------- | ------ |
| user_name_unique  | Unique   | name   |
| user_email_unique | Unique   | email  |
| user_phone_unique | Unique   | phone  |

#### 建表 SQL

```sql
create table `user` (
`id` int unsigned not null auto_increment primary key,
`name` varchar(16) not null,
`email` varchar(64) not null,
`email_verified_at` datetime null,
`phone` varchar(16) not null,
`phone_verified_at` datetime null,
`password` varchar(64) not null,
`avatar` varchar(128) not null,
`api_token` varchar(64) not null,
`remember_token` varchar(64) not null,
`created_at` datetime not null default current_timestamp,
`updated_at` datetime null on update current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb auto_increment=1000;

alter table `user` add unique `user_name_unique`(`name`);
alter table `user` add unique `user_email_unique`(`email`);
alter table `user` add unique `user_phone_unique`(`phone`);
```
