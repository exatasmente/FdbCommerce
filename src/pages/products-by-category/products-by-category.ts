
import { Component } from '@angular/core';
import {IonicPage,NavController, NavParams } from 'ionic-angular';

import { LoadingController } from 'ionic-angular/components/loading/loading-controller';
import { ModalController } from 'ionic-angular/components/modal/modal-controller';
import { ServiceapiProvider } from '../../providers/serviceapi/serviceapi';


@IonicPage()
@Component({
  selector: 'page-products-by-category',
  templateUrl: 'products-by-category.html',
})
export class ProductsByCategoryPage {
  
  categoryProducts: any[];
  cat:any;
  
  constructor(public api : ServiceapiProvider, public navCtrl: NavController, public navParams: NavParams, public loadingCrtl: LoadingController, public modalCtrl : ModalController) {
    this.cat = this.navParams.get("category");
    let loading = this.loadingCrtl.create({content:'Carregando Produtos'});
    loading.present();

    this.api.get("produto?categoria="+this.cat.id).then ( (data)=>{
        this.categoryProducts = data['dados'];
        loading.dismiss();
    },(err)=>{
      console.log(err);
      loading.dismiss();
    });
    
 
  }

  openProductPage(product){
    
    this.navCtrl.push('ProductPage',{product:product});
    
  
    
  } 
  
  openCart(){     
    this.navCtrl.push('CartPage');   
  }  
  openSearch(){
    this.navCtrl.push('SearchPage');
  }
}
