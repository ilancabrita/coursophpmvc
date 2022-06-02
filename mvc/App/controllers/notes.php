<?php

// use App\Core\Controller;
use App\Auth;

class Notes extends App\Core\Controller
{
    public function criar()
    {
        Auth::checkLogin();
        $mensagem = array();

        if(isset($_POST['cadastrar'])):
            if(empty($_POST['titulo'])):
                $mensagem[] = "o campo titulo não pode ser em branco";
            elseif(isset($_POST['texto'])):
                $mensagem[] = "o campo texto não pode ser em branco";
            else:
                // Upload de arquivos
                $storage = new \Upload\Storage\FileSystem('uploads');
                $file = new \Upload\File('foo', $storage);

                // Optionally you can rename the file on upload
                $new_filename = uniqid();
                $file->setName($new_filename);

                // Validate file upload
                // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
                $file->addValidations(array
                (
                    // Ensure file is of type "image/png"
                    new \Upload\Validation\Mimetype('image/png'),

                    //You can also add multi mimetype validation
                    //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                    // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                    new \Upload\Validation\Size('5M')
                ));

                // Access data about the file that has been uploaded
                $data = array
                (
                    'name'       => $file->getNameWithExtension(),
                    'extension'  => $file->getExtension(),
                    'mime'       => $file->getMimetype(),
                    'size'       => $file->getSize(),
                    'md5'        => $file->getMd5(),
                    'dimensions' => $file->getDimensions()
                );

                // Try to upload file
                try 
                {
                    // Success!
                    $file->upload();
                    $mensagem[] = "upload feito com sucesso";

                    $note = $this->model('Note');
                    $note->titulo = $_POST['titulo'];
                    $note->titulo = $_POST['texto'];
                    $note->imagem = $data['name'];
                    $mensagem[] = $note->save();
                } 
                catch (\Exception $e) 
                {
                    // Fail!
                    $errors = $file->getErrors();
                    $mensagem[] = implode("<br>", $errors);
                }

                
            endif;
        endif;

        $this->view('notas/criar', $dados = ['mensagem' => $mensagem]);
    }

    public function ver($id = '')
    {
        $note = $this->model('Note');
        $dados = $note->findId($id);

        $this->view('notes/ver', $dados);
    }

    public function editar($id)
    {
        Auth::checkLogin();
        $mensagem = array();
        $note = $this->model('Note');

        if(isset($_POST['atualizar'])):
            $note->titulo = $_POST['titulo'];
            $note->titulo = $_POST['texto'];
            $mensagem[] = $note->update($id);
        endif;

        if(isset($_POST['atualizarImagem'])):
            // Upload de arquivos
            $storage = new \Upload\Storage\FileSystem('uploads');
            $file = new \Upload\File('foo', $storage);

            // Optionally you can rename the file on upload
            $new_filename = uniqid();
            $file->setName($new_filename);

            // Validate file upload
            // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
            $file->addValidations(array
            (
                // Ensure file is of type "image/png"
                new \Upload\Validation\Mimetype('image/png'),

                //You can also add multi mimetype validation
                //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                new \Upload\Validation\Size('5M')
            ));

            // Access data about the file that has been uploaded
            $data = array
            (
                'name'       => $file->getNameWithExtension(),
                'extension'  => $file->getExtension(),
                'mime'       => $file->getMimetype(),
                'size'       => $file->getSize(),
                'md5'        => $file->getMd5(),
                'dimensions' => $file->getDimensions()
            );

            // Try to upload file
            try 
            {
                // Success!
                $file->upload();
                $mensagem[] = "upload feito com sucesso";

                $note = $this->model('Note');
                $note->titulo = $_POST['titulo'];
                $note->titulo = $_POST['texto'];
                $note->imagem = $data['name'];
                $mensagem[] = $note->updateImagem($id);
            } 
            catch (\Exception $e) 
            {
                // Fail!
                $errors = $file->getErrors();
                $mensagem[] = implode("<br>", $errors);
            }

        endif;

        if(isset($_POST['deletarImagem'])):
            $imagem = $note->findId($id);
            unlink("uploads/".$resultado['imagem']);
            $mensagem[] = $note->deleteImagem($id);
        endif;

        $dados = $note->findId($id);
        $this->view('home/editar', $dados = ['registros' => $dados, 'mensagem' => $mensagem]);
    }

    public function excluir($id = '', $page = '')
    {
        Auth::checkLogin();
        $mensagem = array();
        $note = $this->model('Note');
        $mensagem[] = $note->delete($id);
        $dados = $note->getAll();
        $this->view('home/index', $dados = ['registros' => $dados, 'mensagem' => $mensagem]);
    }
}