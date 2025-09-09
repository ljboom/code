module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'http://pi.exgco.com', // 跨域请求的目标地址
        changeOrigin: true,
        pathRewrite: {
          '^/api': ''  // 将/api替换为空字符串
        },
        // 添加一个函数来动态配置代理
        bypass: function(req, res, proxyOptions) {
          if (req.headers.host === 'pi.exgco.com') {
            return {
              target: 'http://api.example.com',
              changeOrigin: true
            };
          } else {
            return false; // 不进行代理
          }
        }
      }
    }
  }
}
