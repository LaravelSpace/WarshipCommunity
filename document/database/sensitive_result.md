## sensitive_result-敏感信息检查结果表

#### 表结构

| 字段名         | 字段类型        | 是否为空和默认值 | 字段描述                  |
| -------------- | --------------- | ---------------- | ------------------------- |
| id             | bigint unsigned | not null         | 自增主键                  |
| classification | varchar(64)     | not null         | 目标类型                  |
| target_id      | int unsigned    | not null         | 目标 id                   |
| result_data    | varchar(255)    | null default ''  | 检查结果                  |
| created_at     | datetime        | not null         | default current_timestamp |

| 索引名                                          | 索引类型 | 字段名                   |
| ----------------------------------------------- | -------- | ------------------------ |
| sensitive_result_classification_target_id_index | Normal   | classification,target_id |

#### 建表 SQL

```sql
create table `sensitive_result` (
`id` bigint unsigned not null auto_increment primary key,
`classification` varchar(64) not null,
`target_id` int unsigned not null,
`result_data` varchar(255) null default '',
`created_at` datetime not null default CURRENT_TIMESTAMP
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `sensitive_result` add index `sensitive_result_classification_target_id_index`(`classification`, `target_id`);
```

