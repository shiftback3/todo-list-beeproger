import { Router } from '@angular/router';
import { Todo } from './../../models/Todo';
import { Component } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { TodoService } from 'src/app/services/todo.service';

@Component({
  selector: 'app-todo-list',
  templateUrl: './todo-list.component.html',
  styleUrls: ['./todo-list.component.scss']
})
export class TodoListComponent {
  
   // imgBaseUrl: string ="https://todo-app.simplensmart.com/storage/" // set image base URL
  imgBaseUrl: string ="http://localhost:8000/storage/" // set image base URL
  isChecked: boolean = false;
  todos!: Array<Todo>;
  constructor(
    public todoService: TodoService, 
    private toasterService: ToastrService,
    private _router: Router
    ) { 
   
  }

  ngOnInit(): void {
    this.getTodos(); // Load initial data is available
    
  }

  
// set Edit data and navigate to edit page
  setEdit(data: any){
    this.todoService.setEditData(data);
    this._router.navigate(['/edit/', data.id])
  
  }
// Toggle todo complition state
  fieldsChange(val:number):void {
    // this.isChecked = !this.isChecked
    this.todoService.toggle('/todos/toggle',val).subscribe(
      response => {
        // console.log(response);
        this.toasterService.success(response.message);
        this.getTodos();
        
      },
      err => {
        this.toasterService.error('something went wrong!');
      }
    )
  }
// Get all todos Function
  getTodos(){
    this.todoService.index('/todos').subscribe(
      response => {
        console.log(response);
        this.todos = response.data.data
        
      },
      err => {}
    )
  }
// window confirmation prompt for dleting data
  confirmDelete(data: number) {
    if (confirm("Do you want to delete Todo?") == true) {
      // console.log("deleted");
      this.deleteTodo(data);
    } else {
      console.log("not deleted");
    }
  }
  // Delete todo
  deleteTodo(val:number){
    this.todoService.delete(`/todos`,val).subscribe(response => {
      this.toasterService.success('Todo Deleted Successfully!');
      console.log(response)
      this.getTodos();
      
  
    })
    
  }
}
