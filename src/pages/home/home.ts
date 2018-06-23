import { Component } from '@angular/core';
import { DestaquesPage } from '../destaques/destaques';
import { CategoriesPage } from '../categories/categories';




@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
  categorias =CategoriesPage;
  destaques =DestaquesPage;

  constructor() {
  
  }
  
  
}