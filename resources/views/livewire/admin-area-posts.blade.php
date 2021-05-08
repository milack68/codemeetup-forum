
<div>
    <div>
        <div class="d-flex justify-content-between align-content-center mb-2">

            <x-table-pagination/>
            <div class="custom-control custom-switch">
                <input wire:model="showDeletedPosts" wire:click="resetPaginatorPage" type="checkbox" class="custom-control-input"
                    id="showDeletedPosts" name="showDeletedPosts" />
                <label class="custom-control-label" for="showDeletedPosts">Show deleted Posts</label>
            </div>
            
            <!-- features are not yet implemented
            <div> 
                <button wire:click.prevent="showPostForm" class="btn btn-sm btn-success">
                    <i class="fas fa-plus-circle mr-2"></i>Add new Post
                </button>
            </div>
            <div class=" col-md-4">
                <input wire:model="search" type="search" class="form-control" placeholder="Search in name and description">
            </div>
            -->
        </div>
        
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Id</th>
                        <th wire:click="sortBy('category_id')" style="cursor: pointer;">Category @include('components.sort_icon',['field' => 'category_id'])</td>
                        <th wire:click="sortBy('title')" style="cursor: pointer;">Title @include('components.sort_icon',['field' => 'title'])</th>
                        <th wire:click="sortBy('user_id')" style="cursor: pointer;">User @include('components.sort_icon',['field' => 'user_id'])</th>
                        <th wire:click="sortBy('reply_count')" style="cursor: pointer;">Replies @include('components.sort_icon',['field' => 'reply_count'])</th>
                        <th wire:click="sortBy('created_at')" style="cursor: pointer;">created @include('components.sort_icon',['field' => 'created_at'])</th>
                        <th wire:click="sortBy('updated_at')" style="cursor: pointer;">updated @include('components.sort_icon',['field' => 'updated_at'])</th>
                        @if($showDeletedPosts)
                        <th wire:click="sortBy('deleted_at')" style="cursor: pointer;">deleted @include('components.sort_icon',['field' => 'deleted_at'])</th>
                        @endif
                        <th>Action</th>
                    </tr>
                    
                    @foreach ($posts as $post)
                    
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name}}</td>
                            <td>{{ $post->reply()->count()}}</td>                            
                            <td>{{ $post->created_at->format('d.m.Y H:i:s') }}</td>
                            <td>{{ $post->updated_at->format('d.m.Y H:i:s') }}</td>
                            @if($showDeletedPosts)
                            <td>{{ $post->deleted_at->format('d.m.Y H:i:s') }}
                            @endif
                            <td>
                                @if (!$showDeletedPosts)
                                    <a href="{{ route('posts.show',$post)}}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <button wire:click="selectPost({{ $post->id }}, 'delete')"
                                        class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                               
                                    <button  @if (!$post->category) disabled title="{{ __('you cant restore this post because its category has been deleted') }}" @endif wire:click="selectPost({{ $post->id }}, 'restore')"
                                        class="btn btn-secondary btn-sm">                                        
                                        <i class="fas fa-trash-restore"></i>                                        
                                    </button>
                                    
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-sm-6 offset-5">
                {{ $posts->firstItem()}} - {{ $posts->lastItem() }} from {{ $posts->total() }} results
                {{ $posts->links() }}
            </div>
        </div>
    </div>


<!-- Modal for Delete Post -->
<div class="modal fade" id="deleteModelInstanceModal" tabindex="-1" aria-labelledby="deleteModelInstanceModalLabel" aria-hidden="true" wire:ignore.self>
<div class="modal-dialog">
    <form wire:submit.prevent="delete">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModelInstanceModalLabel">Delete this Post?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">                
                <p>Title: {{ $title }}<br><small>by: {{ $userName }}</small></p>
                <p>There are <strong>{{$replyCount}}</strong> replies to this post. Deleting this post will also delete all replies, uploads and comments associated with it.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </div>
    </form>
</div>
</div>

<!-- Modal for Restore Post-->
<div class="modal fade" id="restoreModelInstanceModal" tabindex="-1" aria-labelledby="restoreModelInstanceModalLabel" aria-hidden="true" wire:ignore.self>
<div class="modal-dialog">
    <form wire:submit.prevent="restore">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="restoreModelInstanceModalLabel">Restore this Post?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Title: {{ $title }}<br><small>by: {{ $userName }}</small></p>
                <p>There are <strong>{{$replyCount}}</strong> replies to this post.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Yes, Restore</button>
            </div>
        </div>
    </form>
</div>
</div>
    

    

</div>
 