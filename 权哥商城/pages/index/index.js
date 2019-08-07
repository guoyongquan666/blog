Page({


  data: {
    quicks:[],
    ym: 'http://sc.com/static/upload/',
    imageskus: "http://sc.com/static/upload/",
    logos:[
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/20983/16/10753/6124/5c8a16aaE5d6b15d7/01e0e818a7505267.png" ,title: "权哥超市"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/39401/17/2391/5859/5cc06fcfE2ad40668/28cda0a571b4a576.png",title: "权哥超市"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/17169/3/4127/4611/5c2f35cfEd87b0dd5/65c0cdc1362635fc.png",title: "权哥服饰"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/27962/13/1445/4620/5c120b24Edd8c34fe/43ea8051bc50d939.png",title: "权哥生鲜"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t16990/157/2001547525/17770/a7b93378/5ae01befN2494769f.png",title: "权哥到家"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t18454/342/2607665324/6406/273daced/5b03b74eN3541598d.png",title: "充值缴费"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t22228/270/207441984/11564/88140ab7/5b03fae3N67f78fe3.png",title: "9.9元拼"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/7068/29/8987/5605/5c120da2Ecae1cc3a/016033c7ef3e0c6c.png",title: "领劵"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t22120/183/200496447/5553/91ed22e0/5b03b7b8Ncea08c5b.png",title: "省钱"},
      { image: "https://m.360buyimg.com/mobilecms/s120x120_jfs/t1/22262/9/1470/4527/5c120cd0E5d3c6c66/4792ec307a853e9f.png",title: "会员中心"}
    ],
    imgUrls: [
  'https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/23112/33/6431/99212/5c540d7fEf8000223/fddb6b047c02ba3d.jpg!cr_1125x549_0_72!q70.jpg.dpg',
      'https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/53331/32/6522/95079/5d43abcbE740aacfc/b474ce69a15c8ac9.jpg!cr_1125x549_0_72!q70.jpg.dpg',
      'https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/55579/20/6565/144212/5d428e04E9ee042a5/e4ac0536c4a8df3c.jpg!cr_1125x549_0_72!q70.jpg.dpg',
      "https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/79633/4/6027/55816/5d424c38Ef3e8b2cb/7f59c1a0fb9c4877.jpg!cr_1125x549_0_72!q70.jpg.dpg",
      "https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/55026/6/6626/151829/5d42ecc8Ebbf5ddbb/90587f0f43f7cf4d.jpg!cr_1125x549_0_72!q70.jpg.dpg",
      "https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/10798/34/12141/189137/5c7668a1Eef6e08ec/1b7434cc17f6306d.jpg!cr_1125x549_0_72!q70.jpg.dpg",
      "https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/83842/16/5826/186853/5d3fde34Ed62379f0/ca6ed06613ff9019.jpg!cr_1125x549_0_72!q70.jpg.dpg",
      "https://m.360buyimg.com/mobilecms/s750x366_jfs/t1/80561/15/5163/88341/5d355dbbE2426fbc1/507ccc0f04dba6a2.jpg!cr_1125x549_0_72!q70.jpg.dpg"
    ],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000
  },
  changeIndicatorDots: function (e) {
    this.setData({
      indicatorDots: !this.data.indicatorDots
    })
  },
  changeAutoplay: function (e) {
    this.setData({
      autoplay: !this.data.autoplay
    })
  },
  intervalChange: function (e) {
    this.setData({
      interval: e.detail.value
    })
  },
  durationChange: function (e) {
    this.setData({
      duration: e.detail.value
    })
  },
  onShow: function () {
   
  },
  /**
 * 生命周期函数--监听页面加载
 */
  onReady: function () {
    var that = this;
    wx.request({
      url: 'http://lar.com/sku', //仅为示例，并非真实的接口地址
      method: 'GET',
      header: {
        'content-type': 'application/json' // 默认值
      },
      success: function (res) {
        // console.log(res)
        var le = res.data.length;
        // console.log(le);
        for (var i = 0; i < le; i++) {
          var l = res.data[i].attrs.length;

          if (res.data[i]) {
            res.data[i].price = res.data[i].price
          }
          var sj = Math.floor(Math.random() * l);

          for (var j = 0; j < le; j++) {
            if (res.data[i].attrs[sj].type == 2) {
              res.data[i].image = res.data[i].attrs[j].pivot.value;
              break;
            }
          }
          res.data[i].image
        }
        that.setData({
          quicks: res.data
        })
      }
    })
  },

})