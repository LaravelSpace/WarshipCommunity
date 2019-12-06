## failed_jobs-Laravel 失败队列表

#### 建表 SQL

```sql
create table `failed_jobs` (
`id` bigint unsigned not null auto_increment primary key,
`connection` text not null,
`queue` text not null,
`payload` longtext not null,
`exception` longtext not null,
`failed_at` datetime not null default current_timestamp
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;
```

