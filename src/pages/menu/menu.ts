import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { HomePage } from '../home/home';

@Component({
  selector: 'page-menu',
  templateUrl: 'menu.html',
})
export class MenuPage {
  tabsPage = HomePage;
  hasLogin: any;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidEnter() {
    this.hasLogin = false;
  }
  openAboutPage() {
    this.navCtrl.push('AboutPage');
  }
  openPageAvatar() {
    if (!this.hasLogin) {
      this.navCtrl.push('LoginPage');
    } else {
      this.navCtrl.push('UserInfoPage');
    }
  }
  openHomePage() {
    this.navCtrl.popToRoot();

  }
  openCartPage() {
    this.navCtrl.push('CartPage');
  }
  openOrdersPage() {
    this.navCtrl.push('OrdersPage');
  }

  logout() {
    



  }

}
