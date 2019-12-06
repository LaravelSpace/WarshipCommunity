## role_permission-角色权限关系表

#### 表结构

| 字段名        | 字段类型     | 是否为空和默认值 | 字段描述                  |
| ------------- | ------------ | ---------------- | ------------------------- |
| id            | int unsigned | not null         | 自增主键                  |
| permission_id | int unsigned | not null         | DB:permission->id         |
| role_id       | int unsigned | not null         | DB:role->id               |
| created_at    | datetime     | not null         | default current_timestamp |

#### 建表 SQL

```sql
create table `role_permission` (
`id` int unsigned not null auto_increment primary key,
`permission_id` int unsigned not null,
`role_id` int unsigned not null,
`created_at` datetime not null default current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;
```

