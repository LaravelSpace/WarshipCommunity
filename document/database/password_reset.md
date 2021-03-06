## password_reset-密码重置表

#### 表结构

| 字段名     | 字段类型     | 是否为空和默认值 | 字段描述                  |
| ---------- | ------------ | ---------------- | ------------------------- |
| id         | int unsigned | not null         | 自增主键                  |
| email      | varchar(64)  | not null         | DB:user->email            |
| token      | varchar(64)  | not null         | 重置密码的 token          |
| created_at | datetime     | not null         | default current_timestamp |

| 索引名                     | 索引类型 | 字段名 |
| -------------------------- | -------- | ------ |
| password_reset_email_index | Normal   | email  |

#### 建表 SQL

```sql
create table `password_reset` (
`id` int unsigned not null auto_increment primary key,
`email` varchar(255) not null,
`token` varchar(255) not null,
`created_at` datetime not null default current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `password_reset` add index `password_reset_email_index`(`email`);
```

