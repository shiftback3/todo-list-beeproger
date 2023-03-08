import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Todo } from '../models/Todo';



@Injectable({
  providedIn: 'root'
})
export class TodoService {

  // API_URL: string = "https://demo-api.simplensmart.com/api"
  API_URL: string = "http://localhost:8000/api"

  constructor(
    private http: HttpClient,
    private _router: Router,

    ) { }
// Get All Todos
    index (sub: string){
    
      return this.http.get<any>(`${this.API_URL + sub}`)
    }
  // Get a Single Todo
    show (id: any,sub: string){
      
      return this.http.get<any>(`${this.API_URL + sub}/${id}`)
    }
  // Create Todo
    create (sub: string,payload: any){
      
      return this.http.post<any>(`${this.API_URL + sub}`, payload)
    }
// Toggle Todo completion status
    toggle (sub: string,id: number){
      
      return this.http.get<any>(`${this.API_URL + sub}/${id}`)
    }
  // Update Todos
    update (sub: string,payload: any,id: number){
      
      return this.http.put<any>(`${this.API_URL + sub}/${id}`, payload)
    }
    update_special (sub: string,payload: any,id: string){
      
      return this.http.post<any>(`${this.API_URL + sub}/${id}`, payload)
    }
  
    // Delete Todos
    delete (sub: string, id: number){
      
      return this.http.delete<any>(`${this.API_URL + sub}/${id}`)
    }
// Set editable data in loacl storage
    setEditData(data: Todo){
      return localStorage.setItem('todoDetails',JSON.stringify(data));
      }

      // Get edit data from local storage
      getEditData(){
      return JSON.parse(localStorage.getItem('todoDetails')!);
      }

  }
