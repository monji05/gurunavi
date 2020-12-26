module.exports = {
    devServer: {
        proxy: {
            '/api/': {
                target: "https://webservice.recruit.co.jp/hotpepper/gourmet/v1/"
            }
        }
    }
  };