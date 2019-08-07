// pages/search/search.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    cateItems:[
      {
        ishaveChild: true,
        children:
          [],
          
      }
         
    ],
    ym: 'http://sc.com/static/upload/',
    open: false,
    // mark 是指原点x轴坐标
    mark: 0,
    // newmark 是指移动的最新点的x轴坐标 
    newmark: 0,
    istoright: true,

    curNav: 1,
    curIndex: 0,

  },
 

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    wx.request({
      url: 'http://lar.com/category', //仅为示例，并非真实的接口地址
      method: 'GET',
      header: {
        'content-type': 'application/json' // 默认值
      },
      data:{},
      success:function (res){
        console.log(res.data)
        var le = res.data.length;
        var a = [];
        for (var i = 0; i < le; i++) {
          var l = res.data[i].pid
          if (l == 0) {
            a.push(res.data[i])
          }
        }


        var curIndex = that.data.curIndex;
        var le = a[curIndex].goods.length;
        for (var i = 0; i < le; i++) {

          var l = a[curIndex].goods[i].skus.length

          var sj = Math.floor(Math.random() * l);

          if (le != 0) {
            a[curIndex].ishaveChild = true;
          } else {
            a[curIndex].ishaveChild = false;
          }

          var leg = a[curIndex].goods[i].skus[sj].attrs.length;

          for (var j = 0; j < le; j++) {
            a[curIndex].goods[i].price = a[curIndex].goods[i].skus[sj].price

            if (a[curIndex].goods[i].skus[sj].attrs[j].type == 2) {
              a[curIndex].goods[i].image = a[curIndex].goods[i].skus[sj].attrs[j].pivot.value;

              a[curIndex].goods[i].sku_id = a[curIndex].goods[i].skus[sj].attrs[j].pivot.sku_id;
              break;
            }
          }
          a[curIndex].goods[i].image
        }




        that.setData({
          cateItems: a
        })
        console.log(that.data.cateItems);
      },
      fail: function (err) {

      }
    })
  },

  /**
   * 事件处理函数
   */
  switchRightTab:function (e){
    // 获取item项的id，和数组的下标值
    let id = e.target.dataset.id,
      index = parseInt(e.target.dataset.index);
    // 把点击到的某一项，设为当前index
    this.setData({
      curNav: id,
      curIndex: index
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
 
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },
  detail: function (e) {
    console.log(e);
    wx.navigateTo({
      url: '/pages/introduction/introduction?goodsId=' + e.currentTarget.dataset.goodsid + '&goodsImage=' + e.currentTarget.dataset.goodsimage + '&goodsPrice=' + e.currentTarget.dataset.goodsprice + '&goodsName=' + e.currentTarget.dataset.goodsname,
    })
  }
})