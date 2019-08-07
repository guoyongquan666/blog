// pages/cart/cart.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    carArray: [
      {
        carImage: '/pages/static/zhutu.jpg',
        carTitle: '木村耀司登山旅行大学生户外情侣双肩背包外带小背包',
        carPrice: '¥192.00',
        carNum: 1,
        carShow: true
      },
      {
        carImage: '/pages/static/zhutu.jpg',
        carTitle: '木村耀司登山旅行大学生户外情侣双肩背包外带小背包',
        carPrice: '¥193.00',
        carNum: 1,
        carShow: true
      },
      {
        carImage: '/pages/static/zhutu.jpg',
        carTitle: '木村耀司登山旅行大学生户外情侣双肩背包外带小背包',
        carPrice: '¥194.00',
        carNum: 1,
        carShow: true
      }
    ]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

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
  carAdd: function (event) {
    var that = this;
    var index = event.target.dataset.alphaBeta;
    var con = that.data.carArray[index].carNum + 1;
    var key = 'carArray[' + index + '].carNum';
    var obj = {};
    obj[key] = con;
    this.setData(obj);
  },
  carReduce: function (event) {
    var that = this;
    var index = event.target.dataset.alphaBeta;
    var con = that.data.carArray[index].carNum;
    var key = 'carArray[' + index + '].carNum';
    var obj = {};
    if (con <= 1) {
      obj[key] = 1;
      that.setData(obj);
    }
    else {
      con--;
      obj[key] = con;
      that.setData(obj);
    }
  },
  carRemove: function (event) {
    var that = this;
    var index = event.target.dataset.alphaBeta;
    var key = 'carArray[' + index + '].carShow';
    var obj = {};
    obj[key] = false;
    this.setData(obj);
  },
  toPay: function () {
    wx.navigateTo({
      url: '../pay/pay'
    })
  }
})