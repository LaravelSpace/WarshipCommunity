## failed_jobs-Laravel 队列表

#### 建表 SQL

```sql
create table `jobs` (
`id` bigint unsigned not null auto_increment primary key,
`queue` varchar(255) not null,
`payload` longtext not null,
`attempts` tinyint unsigned not null,
`reserved_at` int unsigned null,
`available_at` int unsigned not null,
`created_at` int unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine=innodb;

alter table `jobs` add index `jobs_queue_index`(`queue`);
```

