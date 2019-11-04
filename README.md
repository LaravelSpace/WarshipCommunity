# 更新记录

## 2019-11-01

- 考虑使用 OAuth2.0 认证替代 JWT 认证。
- 两者的应用场景不同，可以尝试二者结合使用。

## 2019-10-31

- 实现 JWT 认证。

## 2019-10-29

- 整理用户模块

## 2019-10-28

- 数据库添加索引。
- 使用 seed 创造测试数据。
- blade 模板，功能拆分成 vue 子组件

## 2019-10-27

- 完善 article 模块的增删改查。
- api 访问未定义的路由或者路由方法直接返回 404。

## 2019-10-25

- 请求日志记录中间件，使用数据库记录文件名的方式记录日志。
- 初步实现通过 ip 地址限制请求次数。

## 2019-10-24

- 添加请求日志记录中间件，用于记录请求和响应数据。
- 规范代码规范，修改部分代码。

## 2019-10-22

- 重新定义路由，web、api 分开处理。
- 调整前端的请求路由。
- 为封装 Model 做准备。

## 2019-10-11

- 整合 blade 页面

## 2019-10-10

- PHP 版本升级至 7.2.23
- 项目升级至 Laravel 6.0
- 添加 `app/helpers.php`

## 2019-08-11

- 新建一个项目存放算法和设计模式的 Demo
- 新建一个项目存放笔记草稿原稿

## 2019-08-04

- 增加 `Service` 目录，这么做是为了让功能模块的 **Service** 和框架本身的模块目录可以直接映射。
  比如：**Community** 功能模块 `app/Service/Community` 和 框架本身的 **Job** 模块 `app/Job/Community` 可以直接映射。
- 根据 `Service` 目录，调整 `resources/views` 视图目录。
- 使用 JWT 登录。

## 2019-08-03

- 添加 `unity` 笔记目录。
- 调整笔记草稿原稿目录，将图片移动到各个分类下的 `images` 目录。
- 修改笔记中的图片应用路径。

## 2019-07-31

- 调整笔记草稿原稿目录。
- 将原有笔记分类至不同目录，增加无类别 `unclassified` 目录。

## 2019-07-30

- 添加 `tymon/jwt-auth`。
- 重新定义目录结构，添加多个分类目录。

## 2019-07-29

- 整理文档和笔记。

## 2019-07-24

- 运行 `php artisan migrate` 命令时判断运行环境。
- 解决 `php artisan migrate` 命令重复建表的问题。
- 记录 `php artisan migrate` 命令生成的建表语句。

## 2019-07-23

- 整理测试环境的路由。
- 修改表名 `community_articles` 为 `articles`。
- 修改表名 `community_comments` 为 `comments`。
- 整理代码结构，添加注释。

## 2019-07-22

- 动态规划，国王的金矿问题。
- 动态规划，增加抽象类，合并递归思路和递归步骤部分的代码。
- 增加动态规划算法的注释，便于理解。
- `NotesManuscript` 增加动态规划的总结 `dynamic-programming.md`。

## 2019-07-16

- 实用动态规划实现最小公共子序列问题。

## 2019-07-14

- 把笔记原稿从单独的项目移动到本项目 `app` 目录下。
- 将算法和笔记原稿从项目功能模块分离出去。
- 算法以及实验性质的代码移动到 `app/AlgorithmDemo` 目录下。
- 笔记原稿移动到 `app/NotesManuscript` 目录下，统一使用 **markdown** 格式。
- 笔记原稿的图片资源移动到 `app/NotesManuscript/images` 目录下，统一使用 **jpg|jpeg|png** 格式。
- 动态规划，爬楼梯问题。
- 动态规划，矩阵最小路径问题。
- 动态规划，找出找零钱总方法数问题。

## 2019-07-11

- 添加权限管理页面。
- 添加角色模块。
- 添加权限模块。
- 修改没有意义的双引号为单引号。

## 2019-07-06

- 把 **live2d** 单独放到一个模板里，暂时禁用。
- 修改注册模块。

## 2019-07-01

- 移动 `App\User` 到 `App\Community\User\Model\User`

## 2019-06-30

- 创建帖子时增加敏感词检测。
- 初步完成权限角色管理的表结构设计。

## 2019-06-27

- 修改 **DFA** 敏感词匹配算法，解决敏感词连续出现时匹配不到的问题。

## 2019-06-23

- 添加 `sparksuite/simplemde-markdown-editor`。
- 添加 `erusev/parsedown`。
- 添加 **live2d** 参考 `eeg1412/Live2dHistoire`。

## 2019-06-22

- Laravel 5.7 升级至 Laravel 5.8。

## 2019-06-13

- 选择排序。
- 插入排序。

## 2019-06-12

- 冒泡排序。
- 冒泡排序的改进方案。
- 快速排序。

## 2019-06-09

- 归并排序。

## 2019-06-04

- 完善发帖、改贴基础功能。

## 2019-06-02

- 暂时移除 **API**。
- 使用 **Restful** 路由替换原有路由。

## 2019-05-21

- 修改路由和控制器请求结构。

## 2019-05-19

- 完善用户登录。
- 调试 **API-Token**。

## 2019-05-17

- 规范化处理请求返回状态码。
- 重行定义请求返回格式。
- 一张字符画 (～￣▽￣)～ 。

## 2019-05-16

- 调整代码模块结构。
- 重行定义代码分层。
- 完善敏感词匹配模块。
- 调整测试控制器入口。
- 重新定义请求返回数据结构。
- 定义常用变量。

## 2019-04-21

- 调整代码模块结构。
- 重行定义代码分层。
- 完善注册流程。

## 2019-04-11

- 定义异常。

## 2019-04-10

- 用户注册后台逻辑。

## 2019-04-09

- 用户注册页面。

## 2019-03-25

- 移除 `.idea` 目录。

## 2019-03-09

- 重新定义文件目录结构。

## 2019-01-30

- 使用 **DFA** 算法实现敏感词匹配。

## 2018-12-26

- 用户表添加头像字段。
- 生成用户头像图片测试数据。
- 用户模型关联帖子模型。

## 2018-12-23

- 引入 **Vue**。
- 引入 **Axios**。
- 引入 **Lodash**。
- 修改主界面。

## 2018-12-18

- 引入 **jQuery**。
- 引入 **Bootstrap**。
- 创建主界面。

## 2018-12-15

- 创建数据表迁移文件(migration)。
- 生成数据表对应测试数据(seed)。

## 2018-12-13

- 创建用户模型。
- 创建帖子模型。

## 2018-12-11

- 确立项目基本文件目录。

## 2018-12-08

- 搭建框架。
- 更改部分配置。
