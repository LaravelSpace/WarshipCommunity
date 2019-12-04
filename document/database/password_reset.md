## password_reset

#### 表结构

| 字段名 | 字段类型 | 是否为空和默认值 | 字段描述 |
| ------ | -------- | ---------------- | -------- |
|        |          |                  |          |
|        |          |                  |          |
|        |          |                  |          |

#### 建表 SQL

```sql
create table `password_reset` (
`email` varchar(255) not null,
`token` varchar(255) not null,
`created_at` datetime not null default current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `password_reset` add index `password_reset_email_index`(`email`);
```

