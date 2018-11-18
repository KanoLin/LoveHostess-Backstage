# 爱上女主播

## api

## 报名

- 路由:/api/signUp
- 请求方式：POST
- 请求内容：

    | 字段|格式|说明|
    |:----|----|----|
    |name|string|选手姓名|
    |grade|string|选手年级|
    |academy|string|选手学院|
    |tele|string，11位手机号|选手手机|
    |time|string，为时间段开始时间，格式"Y-m-d H:i:s"|选手时间|
- 返回参数：
    |字段|格式|说明|
    |----|-|-|
    |err_code|int|错误代码，0为正常|
    |err_msg|string|错误信息，正常为''|

---

## 投票

### 获得参赛人员信息

- 路由: **api/Info**
- 请求方法: **POST**
- 返回参数:

    |字段|格式|说明|
    |-|-|-|
    |err_code|int|错误代码，0为正常|
    |err_msg|string|错误信息，正常为''|
    |info|array|包含8个参赛人员的infomation对象数组|

        information 对象的属性定义
        information:{
            imgsrc: string[url1,url2,url3],         // 照片url:正方形、矩形、圆形
            name: string,           // 姓名
            id: int,                // 号数
            declaration: string,    // 个人宣言
            audiosrc: string,       // 音频url
            votes: number           // 投票数
        }

### 提交投票

- 路由: **api/Vote**
- 请求方法: **POST**
- 请求内容:

    |字段|格式|说明|
    |-|-|-|
    |id|int|选手id|

- 返回参数

    |字段|格式|说明|
    |-|-|-|
    |err_code|int|同上|
    |err_msg|string|除一般错误信息外，如第二次提交同样返回错误信息|

### 检查登陆

- 路由: **api/checkLogin**
- 请求方法: **POST**
- 返回参数

    |字段|格式|说明|
    |-|-|-|
    |err_code|int|同上|
    |err_msg|string|已登陆返回''|
