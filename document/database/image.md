## image-图片

#### 表结构

| 字段名     | 字段类型     | 是否为空和默认值 | 字段描述                  |
| ---------- | ------------ | ---------------- | ------------------------- |
| id         | int unsigned | not null         | 自增主键                  |
| name       | varchar(128) | not null         | 图片文件名称              |
| type       | varchar(64)  | null default ''  | 图片类型                  |
| user_id    | int unsigned | not null         | 图片所属用户 ID           |
| created_at | datetime     | not null         | default current_timestamp |

| 索引名              | 索引类型 | 字段名  |
| ------------------- | -------- | ------- |
| image_name_unique   | Unique   | name    |
| image_user_id_index | Normal   | user_id |

#### 建表 SQL

```sql
create table `image` (
`id` int unsigned not null auto_increment primary key,
`name` varchar(255) not null,
`type` varchar(64) not null,
`user_id` int unsigned not null,
`created_at` datetime default CURRENT_TIMESTAMP not null
)default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `image` add unique `image_name_unique`(`name`)
alter table `image` add index `image_user_id_index`(`user_id`)
```