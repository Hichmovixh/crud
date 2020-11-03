<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */
namespace App\Controller;
use App\Model\SizeManager;
/**
 * Class SizeController
 *
 */
class SizeController extends AbstractController
{
    /**
     * Display picture listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $sizeManager = new SizeManager();
        $pictures = $sizeManager->selectAll();
        return $this->twig->render('Picture/index.html.twig', ['pictures' => $pictures]);
    }
    /**
     * Display picture informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $sizeManager = new SizeManager();
        $picture = $sizeManager->selectOneById($id);
        return $this->twig->render('Picture/show.html.twig', ['picture' => $picture]);
    }
    /**
     * Display picture edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $sizeManager = new SizeManager();
        $picture = $sizeManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $picture['number'] = $_POST['number'];
            $pictureManager->update($picture);
        }
        return $this->twig->render('Picture/edit.html.twig', ['picture' => $picture]);
    }
    /**
     * Display picture creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pictureManager = new pictureManager();
            $picture = [
                'number' => $_POST['number'],
            ];
            $id = $sizeManager->insert($picture);
            header('Location:/picture/show/' . $id);
        }
        return $this->twig->render('Picture/add.html.twig');
    }
    /**
     * Handle picture deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $sizeManager = new SizeManager();
        $sizeManager->delete($id);
        header('Location:/picture/index');
    }
