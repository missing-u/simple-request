###　　在  GuzzleHttp　的基础上　发送请求简要封装


####  示例
#####  GET
```
        $url = 'http://mock.server.com/echo';
        
        $illumination = '请求说明';
        
        $info = SimpleRequest::json_get($illumination, $url); // [ "echo" => "echo" ]
        
```

```
      $url = 'http://mock.server.com/echo/params/reflect';
      
      $illumination = '请求说明';

      $params = [
          'user' =>
              [
                  'name' => 'yang',
                  'age'  => 10,
              ],
      ];

     $info = SimpleRequest::json_get($illumination, $url, $params); 
      
     $this->assertTrue(
        $info == $params
     );
      
```