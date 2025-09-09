// 创建一个js文件 使用全局mixins，方便方法的使用，route-mixins.js
const identifying = '$RT' // 特殊标识，做区分使用

function isArray(value) {
    return Array.isArray(value);
}

function isObject(value) {
    return typeof value === 'object' && value !== null;
}

function isNull(value) {
    return value === null;
}
/**
 * 判断是否是 "" 或 undefined 或 null 或 {} 或 []
 * @param data
 * @returns {Boolean}
 */
function isBlank(t) {
    return t === "" || t === undefined || isNull(t) || (isObject(t) && JSON.stringify(t) === "{}") || (isArray(t) && t.length < 1);
}

export default {
    data() {
        return {}
    },

    methods: {
        /**
          * 跳转路由，并存下 params
          * @param {String|Object} route 路由对象
          * @param {Boolean} isStorage 是否使用storage
          * @param {Boolean} isPush 是否使用 push 跳转
          */
        $openPageParams(route, isStorage = true, isPush = true) {
            // 判断是否为对象
            if (route instanceof Object) {
                // 解构出params
                const { name, params } = route
                // 判断是否需要存localStorage 并且 不为空对象
                if (isStorage && !isBlank(params)) {
                    // 将数据转码放入localStorage中，如果会加密，把数据加密更安全哦   
                    const data = encodeURIComponent(JSON.stringify(params))
                    localStorage.setItem(`${identifying}${name}`, data)
                }
            }
            if (isPush) {
                // 跳转路由   push     
                this.$router.push(route)
            } else {
                this.$router.replace(route)
            }

        },

        // B页面获取参数使用方法
        $getRouteParams() {
            // 将数据解构
            let { params, name, ...route } = this.$route
            // 如果 params 不存在数据
            if (isBlank(params)) {
                // 获取本地数据
                const localParams = localStorage.getItem(`${identifying}${name}`)
                // 本地数据不为空
                if (!isBlank(localParams)) {
                    params = JSON.parse(decodeURIComponent(localParams))
                }
            }
            // return 路由对象
            return { ...route, name, params: params || {} }
        },

        // 关闭路由，并跳转到下一个路由（建议关闭路由用这个，因为这个可以把localStorage清除）
        $closePageParams(nextRoute, isStorage = true) {
            // 先获取参数
            const { name } = this.$getRouteParams()
            localStorage.removeItem(`${identifying}${name}`)
            this.$nextTick(() => {
                //判断是否需要跳转到下一个路由
                if (!isBlank(nextRoute)) {
                    // 跳转下一个路由
                    this.$openPageParams(nextRoute, isStorage, false)
                } else {
                    this.$router.go(-1)
                }
            })
        }
    }
}
