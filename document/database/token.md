## token-授权表

#### 表结构

| 字段名        | 字段类型     | 是否为空和默认值 | 字段描述                    |
| ------------- | ------------ | ---------------- | --------------------------- |
| id            | int unsigned | not null         | 自增主键                    |
| client        | varchar(32)  | not null         | 用户类型                    |
| client_id     | int unsigned | not null         | 用户 id                     |
| access_token  | varchar(64)  | not null         | 授权 token                  |
| expires_at    | datetime     | not null         | 有效时间                    |
| refresh_token | varchar(64)  | not null         | 刷新 token                  |
| scope         | varchar(128) | null default ''  | 权限范围                    |
| created_at    | datetime     | not null         | default current_timestamp   |
| updated_at    | datetime     | null             | on update current_timestamp |

| 索引名                       | 索引类型 | 字段名           |
| ---------------------------- | -------- | ---------------- |
| token_client_client_id_index | Normal   | client,client_id |

#### 建表 SQL

```sql
create table `token` (
`id` int unsigned not null auto_increment primary key,
`client` varchar(32) not null,
`client_id` int unsigned not null,
`access_token` varchar(64) not null,
`expires_at` datetime not null,
`refresh_token` varchar(64) not null,
`scope` varchar(128) null default '',
`created_at` datetime not null default current_timestamp,
`updated_at` datetime null on update current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `token` add index `token_client_client_id_index`(`client`, `client_id`);
```