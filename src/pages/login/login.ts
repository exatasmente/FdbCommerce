import { Component } from '@angular/core';
import {IonicPage, NavController, NavParams } from 'ionic-angular';

import { LoadingController } from 'ionic-angular/components/loading/loading-controller';

import { ToastController } from 'ionic-angular/components/toast/toast-controller';
import { FormBuilder, FormGroup, Validators, AbstractControl } from '@angular/forms';
import { ServiceapiProvider } from '../../providers/serviceapi/serviceapi';


@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  authForm: FormGroup;
  constructor(public api: ServiceapiProvider,public formBuilder: FormBuilder, public toastCtrl: ToastController, public loadingCtrl: LoadingController, public navCtrl: NavController, public navParams: NavParams) {

    this.authForm = formBuilder.group({
      username: ['', Validators.compose([Validators.required])],
      password: ['', Validators.compose([Validators.required])]
    });


  }
  onSubmit(value: any): void {
    if (this.authForm.valid) {
      
      this.login(value.username, value.password);
    }
  }

  login(username, password) {
    let loading = this.loadingCtrl.create({
      content: "Aguarde..."
    });
    loading.present();
    this.api.post("auth/login.php",{"login":username,"senha":password}).then((data)=>{
        loading.dismiss();
        console.log(data);
        this.navCtrl.popToRoot();
    });

  }
  signup() {
    this.navCtrl.push('SignupPage');
  }

}
