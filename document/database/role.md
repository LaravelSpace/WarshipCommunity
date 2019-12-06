## role-角色表

#### 表结构

| 字段名     | 字段类型     | 是否为空和默认值 | 字段描述                  |
| ---------- | ------------ | ---------------- | ------------------------- |
| id         | int unsigned | not null         | 自增主键                  |
| name       | varchar(64)  | not null         | 角色名称                  |
| describe   | int unsigned | null default ''  | 角色描述                  |
| created_at | datetime     | not null         | default current_timestamp |

| 索引名           | 索引类型 | 字段名 |
| ---------------- | -------- | ------ |
| role_name_unique | Unique   | name   |

#### 建表 SQL

```sql
create table `role` (
`id` int unsigned not null auto_increment primary key,
`name` varchar(64) not null,
`describe` varchar(255) null default '',
`created_at` datetime not null default current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `role` add unique `role_name_unique`(`name`);
```

