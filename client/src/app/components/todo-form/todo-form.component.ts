import { Component } from '@angular/core';
import {Location} from '@angular/common';
import { FormBuilder, Validators } from '@angular/forms';
import { TodoService } from 'src/app/services/todo.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-todo-form',
  templateUrl: './todo-form.component.html',
  styleUrls: ['./todo-form.component.scss']
})
export class TodoFormComponent {
  file: any;
  loading: boolean = false
  constructor(
    // Laod classes to be used globally in this component
    private _location: Location,
    private fb: FormBuilder,
    public todoService: TodoService,
    private toasterService: ToastrService
    ) 
  {}
// Setup Form builder
  todoForm = this.fb.group({
      
    title: ['', [Validators.required]],
    
  });

// Go back to browser history by one step
  goBack() {
    this._location.back();
  }
// Function to Upload File
  onFileSelected(event:any) {

    this.file = event.target.files[0];
    
}
// Add Todos Function
  addTodo(){
    this.loading = true
    const formData = new FormData();
    formData.append('title',this.todoForm.value.title!) 
    formData.append('image',this.file)
this.todoService.create('/todos',formData).subscribe(
  response => {
    this.toasterService.success(response.message);
    this._location.back();
    this.loading = false 
  },
  err => {
    this.loading = false

    this.toasterService.error("Validation Error!");
  }
)
  }

}
