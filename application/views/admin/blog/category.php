<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card data-table">
    <div class="card-header clearfix">
        <div class="card-title float-left">Blog Category List</div>
        <div class="card-option float-right">
            <button type="button" data-url="blog/editCategory" class="btn btn-sm btn-primary add-new">+ ADD</button>
        </div>
    </div>
    <div class="card-body skui-table" data-url="blog/category">
        <table class="table table-bordred table-striped">
            <thead>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Account">Mohsin</td>
                    <td data-label="Account">Irshad</td>
                    <td data-label="Account">CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                    <td data-label="Account">isometric.mohsin@gmail.com</td>
                    <td data-label="Account">+923335586757</td>
                    <td data-label="Account" class="action-column" data-id="" data-name="">
                        <button class="btn btn-primary btn-sm" data-action="edit" data-url="blog/editCategory" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" data-action="delete" data-url="blog/deleteCategory" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm float-right"></ul>
    </div>
</div>