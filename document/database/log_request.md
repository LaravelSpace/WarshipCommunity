## log_request-请求日志表

#### 表结构

| 字段名      | 字段类型     | 是否为空和默认值 | 字段描述                    |
| ----------- | ------------ | ---------------- | --------------------------- |
| id          | int unsigned | not null         | 自增主键                    |
| ip          | varchar(32)  | not null         | 请求 ip                     |
| client      | varchar(32)  | not null         | 用户类型                    |
| client_id   | int unsigned | not null         | 用户 id                     |
| uri         | varchar(64)  | not null         | 请求路由                    |
| request     | varchar(64)  | not null         | 请求参数                    |
| response    | varchar(64)  | null default ''  | 响应参数                    |
| consumption | int unsigned | null default 0   | 耗时                        |
| created_at  | datetime     | not null         | default current_timestamp   |
| updated_at  | datetime     | null             | on update current_timestamp |

| 索引名                                 | 索引类型 | 字段名               |
| -------------------------------------- | -------- | -------------------- |
| log_request_uri_index                  | Normal   | uri                  |
| log_request_client_client_id_uri_index | Normal   | client,client_id,uri |

#### 建表 SQL

```sql
create table `log_request` (
`id` int unsigned not null auto_increment primary key,
`ip` varchar(32) not null,
`client` varchar(32) not null
`client_id` int unsigned not null,
`uri` varchar(64) not null,
`request` varchar(64) not null,
`response` varchar(64) null default '',
`consumption` int unsigned null default 0,
`created_at` datetime not null default current_timestamp,
`updated_at` datetime null on update current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `log_request` add index `log_request_uri_index`(`uri`);
alter table `log_request` add index `log_request_client_client_id_uri_index`(`client`, `client_id`, `uri`);
```

