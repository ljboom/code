
const ENV = process.env.NODE_ENV
export default {
  DOMAIN: 'https://api.bpeasia.net/',
  // baseURL: ENV == 'development'?'http://154.198.247.81:8091/':'http://154.198.247.81:8091/',
  baseURL: 'https://api.bpeasia.net/',
  // DOMAIN: 'http://127.0.0.1:8099/',
  // /* Util API */
  // baseURL: 'http://127.0.0.1:8099/',
  util: {
    image: '/util/image.html' // 图片上传
  }
}
