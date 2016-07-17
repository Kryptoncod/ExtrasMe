<img src="{{ asset('../resources/assets/images/extra-background.png') }}" class="background-image" style="width:90%;"/>
           <table style="width:80%;" class="card-info">
                          <thead>
                            <tr>
                              <td colspan="2" style="text-align:center; color:white;">
                                KEY DETAILS
                              </td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td style="width:25%;">
                                SALARY
                              </td>
                              <td>
                                {{ $extra[0]->salary }} CHF/Hr
                              </td>
                            </tr>
                            <tr>
                              <td>
                                BENEFITS
                              </td>
                              <td>
                                {{ $extra[0]->benefits }}
                              </td>
                            </tr>
                            <tr>
                              <td>
                                LANG
                              </td>
                              <td>
                                French
                              </td>
                            </tr>
                            <tr>
                              <td>
                                TIME
                              </td>
                              <td>
                                {{ $extra[0]->date.' at '.$extra[0]->date_time }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
        <p>
           DESCRIPTION :<br> {{ $extra[0]->requirements }}
        </p>
<a href="{{ route('extra_apply', $parameter = array('id' => $extra[0]->id, 'username' => $user)) }}" class="apply-button right">APPLY</a>
