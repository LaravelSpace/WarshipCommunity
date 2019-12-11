## discussion-讨论表

#### 表结构

| 字段名     | 字段类型         | 是否为空和默认值   | 字段描述                                  |
| ---------- | ---------------- | ------------------ | ----------------------------------------- |
| id         | int unsigned     | not null           | 自增主键                                  |
| body       | varchar(64)      | not null           | 内容                                      |
| user_id    | int unsigned     | not null           | DB:user->id                               |
| comment_id | int unsigned     | not null           | DB:comment->id                            |
| examine    | tinyint unsigned | not null default 0 | 审核状态：0=未触发,1=待审核,2=通过,3=拒绝 |
| blacklist  | boolean          | not null default 0 | 黑名单：0=不在,1=在                       |
| star_num   | int unsigned     | null default 0     | 星标（点赞）次数                          |
| deleted_at | datetime         | null               | 软删除的时间                              |
| created_at | datetime         | not null           | default current_timestamp                 |
| updated_at | datetime         | null               | on update current_timestamp               |

| 索引名                      | 索引类型 | 字段名     |
| --------------------------- | -------- | ---------- |
| discussion_user_id_index    | Normal   | user_id    |
| discussion_comment_id_index | Normal   | comment_id |

#### 建表 SQL

```sql
create table `discussion` (
`id` int unsigned not null auto_increment primary key,
`body` varchar(64) not null,
`user_id` int unsigned not null,
`comment_id` int unsigned not null,
`examine` tinyint unsigned not null default 0,
`blacklist` tinyint(1) not null default 0,
`star_num` int unsigned null default 0,
`deleted_at` datetime null,
`created_at` datetime not null default CURRENT_TIMESTAMP,
`updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `discussion` add index `discussion_user_id_index`(`user_id`);
alter table `discussion` add index `discussion_comment_id_index`(`comment_id`);
```

