<template>
    <form @submit.prevent="update">
        <p><strong>COMPONENTS <span class="text-danger">*</span></strong></p>
        <p v-if="components.length == 0"><em>No components in the selected template.</em></p>
        <div class="form-group" v-for="component in components" :key="component.id">
            <div v-if="component.type == 'images'">                
                <div v-for="(formComponent, formComponentIndex) in form.components[component.id]" :key="component.id + '-' + formComponentIndex" class="row" style="margin-bottom: 15px;">

                    <div class="col-md-12">
                        <a href class="pull-right" @click.prevent="upload(component.id, formComponentIndex, 'image/png,image/jpg,image/gif,image/jpeg', '')">Upload</a>
                        <label :for="component.slug + '_' + formComponentIndex">
                            {{ component.name }} #{{ formComponentIndex + 1 }} <span class="text-danger">*</span> <em v-if="component.rules.width && component.rules.height">({{ component.rules.width }}px x {{ component.rules.height }}px)</em>
                        </label>
                        <input type="text" class="form-control" :id="component.slug + '_' + formComponentIndex" :placeholder="component.type" v-model="form.components[component.id][formComponentIndex]['_value']">
                        <a href @click.prevent="pushAnotherElementInComponent(component.id)"><span class="text-success" >Add Another</span></a>                        
                        <a href @click.prevent="removeElementAtPositionFromComponent(component.id, formComponentIndex)" v-if="form.components[component.id].length > 1"><span class="text-danger">Remove</span></a>
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type == 'photogallery'">   
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug + '_background_color'">Photogallery Background Color<span class="text-danger">*</span></label>                                         
                       <color-picker v-model="form.components[component.id]['background_color']" :color="form.components[component.id]['background_color']" />                   
                    </div>
                </div>            
                <div v-for="(formComponent, formComponentIndex) in form.components[component.id]['_value']" :key="component.id + '-' + formComponentIndex" class="row" style="margin-bottom: 15px;">

                    <div class="col-md-12">
                        <a href class="pull-right" @click.prevent="upload(component.id, formComponentIndex, 'image/png,image/jpg,image/gif,image/jpeg', '', component.slug)">Upload</a>
                        <label :for="component.slug + '_' + formComponentIndex">
                            {{ component.name }} #{{ formComponentIndex + 1 }} <span class="text-danger">*</span> <em v-if="component.rules.width && component.rules.height">({{ component.rules.width }}px x {{ component.rules.height }}px)</em>
                        </label>
                        <input type="text" class="form-control" :id="component.slug + '_' + formComponentIndex" :placeholder="component.type" v-model="form.components[component.id]['_value'][formComponentIndex]['_value']">
                        <a href @click.prevent="pushAnotherElementInPhotogalleryComponent(component.id)"><span class="text-success" v-if="form.components[component.id]['_value'].length <= 5">Add Another</span></a>
                        <a href @click.prevent="removeElementAtPositionFromPhotogalleryComponent(component.id, formComponentIndex)" v-if="form.components[component.id]['_value'].length > 1"><span class="text-danger">Remove</span></a>
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='text'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_size'" :placeholder="component.type" v-model="form.components[component.id]['size']">
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_background_color'">Background<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['background_color']" :color="form.components[component.id]['background_color']" />
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['foreground_color']" :color="form.components[component.id]['foreground_color']" />
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='subtext'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                    <div class="col-md-3">
                        <label :for="component.slug + '_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_size'" :placeholder="component.type" v-model="form.components[component.id]['size']">
                    </div>                  
                    <div class="col-md-3">
                        <label :for="component.slug + '_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['foreground_color']" :color="form.components[component.id]['foreground_color']" />
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='survey'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug+'_title_value'">Survey Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug+'_title_value'" :placeholder="component.type" v-model="form.components[component.id]['_value']['title']['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                    <div class="col-md-2">
                        <label :for="component.slug + '_title_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_title_size'" :placeholder="component.type" v-model="form.components[component.id]['_value']['title']['size']">
                    </div> 
                     <div class="col-md-2">
                        <label :for="component.slug + '_title_background_color'">Background<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['title']['background_color']" :color="form.components[component.id]['_value']['title']['background_color']" />
                    </div>                   
                    <div class="col-md-2">
                        <label :for="component.slug + '_title_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['title']['foreground_color']" :color="form.components[component.id]['_value']['title']['foreground_color']" />
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug+ '_question_value'">Survey Question<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug+ '_question_value'" placeholder="Question" v-model="form.components[component.id]['_value']['question']['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                    <div class="col-md-3">
                        <label :for="component.slug + '_question_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_question_size'" :placeholder="component.type" v-model="form.components[component.id]['_value']['question']['size']">
                    </div> 
                    <div class="col-md-3">
                        <label :for="component.slug + '_question_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['question']['foreground_color']" :color="form.components[component.id]['_value']['question']['foreground_color']" />
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">                   
                     <div class="col-md-4">
                        <label :for="component.slug + '_box_color'">Box Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['box_color']" :color="form.components[component.id]['_value']['box_color']" />
                    </div> 
                     <div class="col-md-4">
                        <label :for="component.slug + '_yes_button_color'">Yes Button Color<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['yes_button_color']" :color="form.components[component.id]['_value']['yes_button_color']" />
                    </div>                   
                    <div class="col-md-4">
                        <label :for="component.slug + '_no_button_color'">No Button Color<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['no_button_color']" :color="form.components[component.id]['_value']['no_button_color']" />
                    </div>
                </div>
            </div>
             <div v-else-if="component.type =='color'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']" :color="form.components[component.id]['_value']"/>
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>                   
                </div>
            </div>
            <div v-else-if="component.type =='image'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" v-if="component.type == 'image'" @click.prevent="upload(component.id, undefined, 'image/png,image/jpg,image/gif,image/jpeg')">Upload</a>
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span> <em v-if="component.rules.width && component.rules.height">({{ component.rules.width }}px x {{ component.rules.height }}px)</em></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='video'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" v-if="component.type == 'video'" @click.prevent="upload(component.id, undefined, 'video/mp4')">Upload</a>
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span> <em v-if="component.rules.width && component.rules.height">({{ component.rules.width }}px x {{ component.rules.height }}px)</em></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='audio'">
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" v-if="component.type == 'audio'" @click.prevent="upload(component.id, undefined, 'audio/mp3')">Upload</a>
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='timeline'">
              <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <label :for="component.slug + '_title'">Timeline Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']['title']">                        
                    </div>
                </div>

                <div v-for="(formComponent, formComponentIndex) in form.components[component.id]['_value']['values']" :key="component.id + '-' + formComponentIndex" class="row" style="margin-bottom: 15px;">                     
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Timeline Component #{{formComponentIndex+1}}</label>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-6">
                                <label :for="component.slug + '_'+formComponentIndex+'_month'">Month<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_month'" placeholder="June" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['month']">
                                
                            </div>                           
                         <div class="col-md-6">
                                <label :for="component.slug + '_'+formComponentIndex+'_year'">Year<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_year'" placeholder="2018" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['year']">
                                
                            </div>
                        </div>
                       <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-12">
                                <label :for="component.slug + '_'+formComponentIndex+'description'">Description<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'description'" placeholder="description" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['description']">
                               
                            </div>                   
                        </div> 
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-12">
                                <a href class="pull-right" @click.prevent="upload(component.id, formComponentIndex, 'image/png,image/jpg,image/gif,image/jpeg', true)">Upload</a>
                                <label :for="component.slug + '_'+formComponentIndex+'image'">Image<span class="text-danger">*</span> <em>(77px x 73px)</em></label>
                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'image'" placeholder="image" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['image']">
                                                            
                                <a href @click.prevent="pushAnotherTimelineElementInComponent(component.id)" v-if="form.components[component.id]['_value']['values'].length <= 5"><span class="text-success">Add Another</span></a>
                                <a href @click.prevent="removeTimelineElementAtPositionFromComponent(component.id, formComponentIndex)" v-if="form.components[component.id]['_value']['values'].length > 4"><span class="text-danger">Remove</span></a>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div v-else-if="component.type =='hours_of_operation'">
              <div class="row" style="margin-top: 5px;">
                    <div class="col-md-12">
                        <label><u>Hours Of Operation</u></label>                        
                    </div>
                </div>
              <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-6">
                        <label :for="component.slug + '_title'">Hours Of Operation Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug+ '_title'" placeholder="Hours Of Operation" v-model="form.components[component.id]['_value']['title']">                        
                    </div>
                     <div class="col-md-2">
                        <label :for="component.slug + '_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_size'" :placeholder="component.type" v-model="form.components[component.id]['_value']['size']">
                    </div> 
                     <div class="col-md-2">
                        <label :for="component.slug + '_background_color'">Background<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['background_color']" :color="form.components[component.id]['_value']['background_color']" />
                    </div>                   
                    <div class="col-md-2">
                        <label :for="component.slug + '_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['foreground_color']" :color="form.components[component.id]['_value']['foreground_color']" />
                    </div>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-md-12">
                        <label><u>Open Box</u></label>                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                     <div class="col-md-6">
                        <label :for="component.slug + '_open_box_value'">Text<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug+ '_open_box_value'" placeholder="Open" v-model="form.components[component.id]['_value']['open_box']['_value']">
                    </div>  
                    <div class="col-md-2">
                        <label :for="component.slug + '_open_box_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_open_box_size'" :placeholder="component.type" v-model="form.components[component.id]['_value']['open_box']['size']">
                    </div> 
                     <div class="col-md-2">
                        <label :for="component.slug + '_open_box_background_color'">Background<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['open_box']['background_color']" :color="form.components[component.id]['_value']['open_box']['background_color']" />
                    </div>                   
                    <div class="col-md-2">
                        <label :for="component.slug + '_open_box_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['open_box']['foreground_color']" :color="form.components[component.id]['_value']['open_box']['foreground_color']" />
                    </div>                 
                   
                </div> 
                <div class="row" style="margin-top: 5px;">
                    <div class="col-md-12">
                        <label><u>Close Box</u></label>                        
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">                                  
                    <div class="col-md-6">
                        <label :for="component.slug + '_close_box_value'">Text<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug+ '_close_box_value'" placeholder="Close" v-model="form.components[component.id]['_value']['close_box']['_value']">
                    </div>  
                    <div class="col-md-2">
                        <label :for="component.slug + '_close_box_size'">Size <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug + '_close_box_size'" :placeholder="component.type" v-model="form.components[component.id]['_value']['close_box']['size']">
                    </div> 
                     <div class="col-md-2">
                        <label :for="component.slug + '_close_box_background_color'">Background<span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['close_box']['background_color']" :color="form.components[component.id]['_value']['close_box']['background_color']" />
                    </div>                   
                    <div class="col-md-2">
                        <label :for="component.slug + '_close_box_foreground_color'">Text Color <span class="text-danger">*</span></label>
                        <color-picker v-model="form.components[component.id]['_value']['close_box']['foreground_color']" :color="form.components[component.id]['_value']['close_box']['foreground_color']" />
                    </div> 
                </div>

                <div v-for="(formComponent, formComponentIndex) in form.components[component.id]['_value']['values']" :key="component.id + '-' + formComponentIndex" class="row" style="margin-bottom: 15px;">                     
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Hours Of Operation Component #{{formComponentIndex+1}}</label>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-4">
                                <label :for="component.slug + '_'+formComponentIndex+'_day_value'">Day<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_day_value'" placeholder="June" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['day']['_value']">
                                          
                            </div> 
                         <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_day_size'">Size<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_day_size'" placeholder="size" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['day']['size']">                                
                            </div>
                            <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_day_foreground_color'">Text Color<span class="text-danger">*</span></label>
                                <color-picker v-model="form.components[component.id]['_value']['values'][formComponentIndex]['day']['foreground_color']" :color="form.components[component.id]['_value']['values'][formComponentIndex]['day']['foreground_color']" />                                                 
                            </div>                           
                        </div>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-4">
                                <label :for="component.slug + '_'+formComponentIndex+'_open_value'">Open<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_open_value'" placeholder="June" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['open']['_value']">
                                          
                            </div> 
                         <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_open_size'">Size<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_open_size'" placeholder="size" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['open']['size']">                                
                            </div>
                            <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_open_foreground_color'">Text Color<span class="text-danger">*</span></label>
                                <color-picker v-model="form.components[component.id]['_value']['values'][formComponentIndex]['open']['foreground_color']" :color="form.components[component.id]['_value']['values'][formComponentIndex]['open']['foreground_color']" />                                                 
                            </div>                           
                        </div>

                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-md-4">
                                <label :for="component.slug + '_'+formComponentIndex+'_close_value'">Close<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_close_value'" placeholder="June" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['close']['_value']">
                                 <a href @click.prevent="pushAnotherHoursOfOperationElementInComponent(component.id)" v-if="form.components[component.id]['_value']['values'].length <= 9"><span class="text-success">Add Another</span></a>
                                <a href @click.prevent="removeHoursOfOperationElementAtPositionFromComponent(component.id, formComponentIndex)" v-if="form.components[component.id]['_value']['values'].length > 1"><span class="text-danger">Remove</span></a>    
                            </div> 
                         <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_close_size'">Size<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" :id="component.slug + '_'+formComponentIndex+'_close_size'" placeholder="size" v-model="form.components[component.id]['_value']['values'][formComponentIndex]['close']['size']">                                
                            </div>
                            <div class="col-md-4">
                                 <label :for="component.slug + '_'+formComponentIndex+'_close_foreground_color'">Text Color<span class="text-danger">*</span></label>
                                <color-picker v-model="form.components[component.id]['_value']['values'][formComponentIndex]['close']['foreground_color']" :color="form.components[component.id]['_value']['values'][formComponentIndex]['close']['foreground_color']" />                                                 
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <a href class="pull-right" v-if="component.type == 'image' || component.type == 'video' || component.type == 'audio'" @click.prevent="upload(component.id, undefined)">Upload</a>
                        <label :for="component.slug">{{ component.name }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :id="component.slug" :placeholder="component.type" v-model="form.components[component.id]['_value']">
                        <span class="text-danger" :class="{'hidden': errors['component.slug'] == undefined}" style="margin-right:10px;">{{errors['component.slug']}}</span>
                    </div>
                </div>
            </div>
        </div>

        <span class="text-danger" :class="{'hidden': errors['general'] == undefined}" style="margin-right:10px;">{{errors['general']}}</span>
        <br>

        <button class="btn btn-info" :disabled="disable.previewing" @click.prevent="reloadPreview">Reload preview</button>
        <button type="submit" class="btn btn-primary" :disabled="disable.saving">Save</button>
    </form>
</template>

<script>
import FileUpload from './../FileUpload';
import ColorPicker from './../ColorPicker';

export default {
    props: {
        components: {
            type: Array,
            required: true
        },
        unit: {
            type: Object,
            required: true
        },
        redirectTo: {
            type: String,
            required: false
        },
        movingFrom: {
            type: String,
            required: false
        },
        moveTo: {
            type: String,
            required: false
        }
    },

    components: {
        'color-picker': ColorPicker
    },

    data() {
        return {
            form: {
                template_id: this.unit.template_id,
                components: {}
            },
            errors: [],
            disable: {
                saving: false,
                previewing: false
            }
        }
    },

    mounted() {
        let components = {};
        _.forEach(this.components, (component) => {
            components[component.id] = this.unit.components[component.id]
                                            ? this.unit.components[component.id]
                                            : this.defaultValueForDataType(component.type);
        });
        Vue.set(this.form, 'components', components);
    },

    methods: {
        defaultValueForDataType(dataType = 'text') {
            let defaults = {
                text: {_value: '', background_color: '#ffffff', foreground_color: '#000000', size: 12},
                subtext: {_value: '', foreground_color: '#000000', size: 15},
                image: {_value: ''},
                video: {_value: ''},
                qr: {_value: ''},
                images: { _value: [''] },
                photogallery: {_value:{_value: ['']}, background_color: '#ffffff'},
                survey: {_value: {title:{ _value:'',  background_color: '#ffffff', foreground_color: '#000000', size: 30}, question:{ _value:'', foreground_color: '#000000', size: 30}, box_color: '#0FE7D3', yes_button_color: '#59E519', no_button_color: '#D30A0A'}, _yes: 0, _no: 0},
                audio: {_value: ''},
                timeline: {_value: {'title': '', values : {month: '', year: '', description: '', image: ''} }},
                hours_of_operation: {_value: {'title': '', background_color: '#ffffff', foreground_color: '#000000', open_box: { _value: '', background_color: '#ffffff', foreground_color: '#000000', size: 30}, close_box: { _value: '', background_color: '#ffffff', foreground_color: '#000000', size: 30}, size: 30, values : {day: { _value: '', foreground_color: '#000000', size: 30}, open: { _value: '', foreground_color: '#000000', size: 30}, close: { _value: '', foreground_color: '#000000', size: 30}} }}
            }

            return defaults[dataType];
        },
        pushAnotherElementInComponent(componentId) {
            this.form.components[componentId].push({_value: ''});
        },
        removeElementAtPositionFromComponent(componentId, index) {
            this.form.components[componentId].splice(index, 1);
        },
        pushAnotherElementInPhotogalleryComponent(componentId) {
            this.form.components[componentId]['_value'].push({_value: ''});
        },
        removeElementAtPositionFromInPhotogalleryComponent(componentId, index) {
            this.form.components[componentId]['_value'].splice(index, 1);
        },
        pushAnotherTimelineElementInComponent(componentId) {
            this.form.components[componentId]['_value']['values'].push({month: '', year: '', description: '', image: ''});
        },
        removeTimelineElementAtPositionFromComponent(componentId, index) {
            this.form.components[componentId]['_value']['values'].splice(index, 1);
        }, 
        pushAnotherHoursOfOperationElementInComponent(componentId) {
            this.form.components[componentId]['_value']['values'].push({day: { _value: '', foreground_color: '#000000', size: 30}, open: { _value: '', foreground_color: '#000000', size: 30}, close: { _value: '', foreground_color: '#000000', size: 30}});
        },
        removeHoursOfOperationElementAtPositionFromComponent(componentId, index) {
            this.form.components[componentId]['_value']['values'].splice(index, 1);
        },
        reloadPreview() {
            this.disable.previewing = true;

            var self = this;
            var experimentalForm = _.cloneDeep(this.form);
            delete experimentalForm.components;
            experimentalForm.experimental_components = this.form.components;
            
            this.errors = [];
            axios.put('/api/units/' + this.unit.id, experimentalForm)
                .then(response => {
                    this.disable.previewing = false;

                    var frameElement = document.getElementById("renderer-iframe-" + this.unit.id);
                    if(frameElement) frameElement.contentWindow.location.href = frameElement.src + '&is_preview=y';
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.previewing = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                                            
                        self.errors[errorIndex] = error[0];
                    });
                });
        },
        update() {
            this.disable.saving = true;

            var self = this;
            
            this.errors = [];

            axios.put('/api/units/' + this.unit.id, this.form)
                .then(response => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    if(this.moveTo !== undefined) {
                        $('#' + this.movingFrom).collapse('hide');
                        $('#' + this.moveTo).collapse('show');
                    } else {
                        window.location = this.redirectTo;
                    }
                })
                .catch(error => {
                    // Fixing the optimism.
                    this.disable.saving = false;

                    _.forEach(error.response.data.errors, function(error, index) {
                        var errorIndex = _.startsWith(index, '_')
                                            ? _.trim(index, '_')
                                            : index;
                                            
                        self.errors[errorIndex] = error[0];
                    });
                });
        },

        upload(componentId, index = null, accept = '', is_timeline=false, component_slug=undefined) {
            let thiz = this;
            Modal.show(FileUpload, {
                propsData: {
                        apiPath: '/api/upload',
                        accept: accept
                    }
                })
                .then(function(url) {
                    if(index !== null)
                    {
                    console.log(component_slug);
                        if(is_timeline)
                        {
                            Vue.set(thiz.form.components[componentId]['_value']['values'], index, {image: url});
                        } 
                        else if(component_slug == 'photo-gallery')
                        {
                            Vue.set(thiz.form.components[componentId]['_value'], index, {_value: url});   
                        }
                        else 
                        {                        
                            // let currentArray = thiz.form.components[componentId];
                            // currentArray[index] = url;
                            Vue.set(thiz.form.components[componentId], index, {_value: url});
                        }

                    } else {
                        Vue.set(thiz.form.components, componentId, {_value: url});
                    }
                });
        },
    }
}
</script>

