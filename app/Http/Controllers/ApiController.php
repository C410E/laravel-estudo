<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    public function getAllStudents() {
        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
      }
  
      public function createStudent(Request $request) {
        $student = new Student();

        if ($request->has('nome') && !is_null($request->nome)) {
            $student->nome = $request->nome;
        } else {
            return response()->json([
                "error" => "O campo 'nome' não pode ser nulo."
            ], 400);
        }
    
        if ($request->has('curso') && !is_null($request->curso)) {
            $student->curso = $request->curso;
        } else {
            return response()->json([
                "error" => "O campo 'curso' não pode ser nulo."
            ], 400);
        }
    
        $student->save();
    
        return response()->json([
            "message" => "Registro do estudante criado"
        ], 201);
      }
      public function getStudent($id) 
      {
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->tojson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "error" => "Estudante não encontrado."
            ], 404); 
        }
      }
  
      public function updateStudent(Request $request, $id) {
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->nome = is_null($request->nome) ? $student->nome : $request->nome;
            $student->curso= is_null($request->curso) ? $student->curso : $request->curso;
            $student->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
            
        }
      }
  
      public function deleteStudent ($id) {
        if(Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Student not found"
            ], 404);
          }
      }
}
