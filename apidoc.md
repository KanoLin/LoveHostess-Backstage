# 爱上女主播

## api

### 报名

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
