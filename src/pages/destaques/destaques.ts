import { Component } from '@angular/core';
import {NavController} from 'ionic-angular';
import { ToastController } from 'ionic-angular';
import { ModalController } from 'ionic-angular';
import { LoadingController } from 'ionic-angular';
import { NgZone } from '@angular/core';
import {ServiceapiProvider} from '../../providers/serviceapi/serviceapi'


@Component({
  selector: 'page-destaques',
  templateUrl: 'destaques.html',
  

})
export class DestaquesPage {
  page : any;
  products : any[];
  moreProducts: any[];
  
  tabBar : any;
  loadEvent : any;
  constructor(public zone : NgZone, public api : ServiceapiProvider, public navCtrl: NavController, public loadingCrtl: LoadingController , public toastCtrl : ToastController, public modalCtrl : ModalController ) {
    let loading = this.loadingCrtl.create({content:'Carregando Produtos'});
    loading.present();
  this.api.get("produto").then((data)=>{
        try{
          this.zone.run(()=>{
            this.products = data['dados'];
            this.moreProducts = this.products;
            loading.dismiss();
          });
          
          }catch(e){
            loading.dismiss();
            this.toastCtrl.create({
              message:"Algo Inesperado Aconteceu, Estamos tentando Resolver",
              closeButtonText :"Ok",
              showCloseButton : true
              
            }).present();
          }
  
    });
  }
  openProductPage(product){
    this.navCtrl.push('ProductPage',{product:product});
  }
}
