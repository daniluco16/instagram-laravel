<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function save(Request $request) {
        
        //Validacion
        
        $validate = $this->validate($request, [
           
            'image_id' => 'integer',
            'content' => 'string'
            
        ]);
        //Recoger datos
        
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        //Asignar valores a mi nuevo objeto comment.
        $comment = new Comment();
        
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        
        $comment->content = $content;
        
        //Guardar en la bd
        
        $comment->save();
        
        //Redireccion
        
        return redirect()->route('image.detail', ['id' => $image_id])
                ->with([
                    'message' => 'Has publicado tu comentario correctamente'
                ]);
        
    }
    
    public function delete($id) {
        
        //Conseguir datos del usuario identificado
        
        
        $user = \Auth::user();
        
        //Conseguir objeto del comentario
        
        
        $comment = Comment::find($id);
        
        //Comprobar si soy dueño del comentario
        
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
         
            $comment->delete();
        
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message' => 'El comentario se elimino con exito'
                ]);
            
        } else {
            
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message' => 'El comentario no se pudo eliminar con exito'
                ]);
            
        }
        
    }
}
