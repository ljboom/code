const ENV = process.env.NODE_ENV
export default {
  DOMAIN: 'http://127.0.0.1:8095/',
  //baseURL: ENV == 'development' ? 'https://66api.lyi618.net/' : 'https://66api.lyi618.net/',
  baseURL: 'http://127.0.0.1:8095',
  util: {
    image: '/util/image.html' // 图片上传
  }
}

