import { Component, NgZone } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { HomePage } from '../home/home';

/**
 * Generated class for the ProductPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-product',
  templateUrl: 'product.html',
})
export class ProductPage {
  atual = "Visão Geral";
  
  produto: any;
  constructor(public navCtrl: NavController, public navParams: NavParams,public zone : NgZone) {
    this.produto = this.navParams.get("product");
    
    
    if(this.produto == null){
      this.navCtrl.setRoot(HomePage).then(()=>{
        this.navCtrl.popToRoot();
      });
      
    }
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductPage');
  }
  closeModal(){
    this.navCtrl.pop();
  }

}
