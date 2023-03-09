import { Component } from '@angular/core';
import {Location} from '@angular/common';
import { FormBuilder, Validators } from '@angular/forms';
import { TodoService } from 'src/app/services/todo.service';
import { ToastrService } from 'ngx-toastr';
import { Todo } from 'src/app/models/Todo';

@Component({
  selector: 'app-todo-edit',
  templateUrl: './todo-edit.component.html',
  styleUrls: ['./todo-edit.component.scss']
})
export class TodoEditComponent {
  todo!: Todo;
  file: any;
  loading: boolean = false
  constructor(
    // Laod classes to be used globally in this component
    private _location: Location,
    private fb: FormBuilder,
    public todoService: TodoService,
    private toasterService: ToastrService
    ) 
  {
    this.todo = todoService.getEditData();
    this.todoForm.patchValue({
      id: this.todo.id,
      title: this.todo.title,
      
    })
  }
// Setup Form builder
  todoForm = this.fb.group({
      
    id: [0, [Validators.required]],
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
  updateTodo(){
    this.loading = true
    const formData = new FormData();
    formData.append('title',this.todoForm.value.title!) 
    formData.append('image',this.file)
this.todoService.create('/todos/' + this.todoForm.value.id, formData).subscribe(
  response => {
    this.toasterService.success(response.message);
    this._location.back();
    this.loading = false 
  },
  err => {
    this.loading = false

    this.toasterService.error("Validation Error, please provide a valid image(.jpg, .png, .jpeg)!");

  }
)
  }

}
