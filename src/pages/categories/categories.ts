import { Component } from '@angular/core';
import {NavController, NavParams } from 'ionic-angular';
import { LoadingController } from 'ionic-angular/components/loading/loading-controller';
import { ModalController } from 'ionic-angular/components/modal/modal-controller';
import { ServiceapiProvider } from '../../providers/serviceapi/serviceapi';



@Component({
  selector: 'page-categories',
  templateUrl: 'categories.html',
})
export class CategoriesPage {
  categorias : any[]
  sub : Map<any,any> = new  Map<any,any>();
  
  constructor(public api : ServiceapiProvider, public navCtrl: NavController, public navParams: NavParams,public loadingCtrl : LoadingController, public modalCtrl : ModalController) {
    if(this.navParams.get("sub")){
      
      this.categorias  = this.navParams.get("sub");
    }else{
      this.categorias = [];
      let loading = this.loadingCtrl.create({content:'Carregando Categorias'});
      loading.present();
      this.api.get("categoria").then ( (data:any)=>{
        let temp : any[] = data['dados'];
        console.log(data['dados']);
        for(let i = 0 ; i < temp.length ; i++){
          if(temp[i].idPai ==0 ){
            this.categorias.push(temp[i]);
            this.sub.set(temp[i].id,[]);
          }else{
            if(this.sub.get(temp[i].idPai)){
              this.sub.get(temp[i].idPai).push(temp[i]);
            }else{
              this.sub.set(temp[i].idPai,[]);
              this.sub.get(temp[i].idPai).push(temp[i]);
            }
            
          }
        }
        
        loading.dismiss();
      },(err)=>{
        console.log(err);
        loading.dismiss();
      });
    }
  }
  openCategoryProductPage(category){
    if(this.sub.get(category.id) && this.sub.get(category.id).length){
      this.navCtrl.push(CategoriesPage,{'sub':this.sub.get(category.id)});  
    }else{
      this.navCtrl.push('ProductsByCategoryPage',{'category':category});
    }
    
  }
  openSearch(){
    this.navCtrl.push('SearchPage');
  }
  openCart(){
    this.navCtrl.push('CartPage');   
  } 

}
