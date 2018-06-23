import { Http } from '@angular/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the ServiceapiProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class ServiceapiProvider {
  host = "http://localhost/Api/";
  constructor(public http: Http) {
  }
  get(path) {
    var promisse = new Promise((resolve, reject) => {
      this.http.get(this.host + path).subscribe((resp: any) => {

        resolve(JSON.parse(resp._body));
      });
    });
    return promisse;
  }
  post(path, data) {
    var promisse = new Promise((resolve, reject) => {
      this.http.post(this.host + path, data).subscribe((resp: any) => {

        resolve(JSON.parse(resp._body));
      });
    });
    return promisse;
  }

}
